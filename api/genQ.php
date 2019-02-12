<?php
require('fpdf/config/dbconfig.php');
require('fpdf/fpdf.php');
require('fpdf/config/code128.php');


class PDF extends FPDF
{
	function Header()
	{
		global $title;

		// Arial bold 15
		$this->SetFont('Arial','B',15);
		
		// Calculamos ancho y posición del título.
		$w = $this->GetStringWidth($title)+6;
		$this->SetX((210-$w)/2);
		
		// Colores de los bordes, fondo y texto
		$this->SetDrawColor(0,80,180);
		$this->SetFillColor(230,230,0);
		$this->SetTextColor(220,50,50);
		
		// Ancho del borde (1 mm)
		$this->SetLineWidth(1);
		
		// Título
		# $this->Cell($w,9,$title,1,1,'C',true);
		# $this->Ln(10);
		
		$this->Cell(40,20);
		// $this->Image('fpdf/monteverde/images/logo.png', 80, 22, 10,10,'PNG');
		$this->Image('../cmr/content/modules/business/images/logo.png', 145, 10, 55, 'PNG');

		
		$this->Ln(25);
		
		#$this->Cell(40,20);
		#$this->Write(5,'A continuación mostramos una imagen ');
		#$this->Image('fpdf/monteverde/images/logo.png' , 80 ,22, 35 , 38,'png', 'http://www.desarrolloweb.com');
	}

	function Footer()
	{
		// Posición a 1,5 cm del final
		$this->SetY(-25);
		
		// Arial itálica 8
		$this->SetFont('Arial','I',9);
		// Color del texto en gris
		$this->SetTextColor(128);
		// Número de página
		$this->Cell(0,10,'SERVICIOS AMBIENTALES Y FORESTALES MONTEVERDE LTDA. / NIT: 811042791-1',0,0,'C');
		$this->Ln(4);
		$this->Cell(0,10,'Telefono(s): 413 90 26 / Email: atencionalcliente@monteverdeltda.com',0,0,'C');
		$this->Ln(4);
		$this->Cell(0,10,'https://monteverdeltda.com/',0,0,'C');
		$this->Ln(4);
		$this->Cell(0,10,'Página '.$this->PageNo(),0,0,'C');
		$this->Ln(4);
	}

	function ChapterTitle($num, $label)
	{
		// Arial 12
		$this->SetFont('Arial','',8);
		
		// Color de fondo
		$this->SetFillColor(200,220,255);
		
		// Título
		$this->Cell(0,6,"Capítulo $num : $label",0,1,'L',true);
		
		// Salto de línea
		$this->Ln(4);
	}

	function ChapterBody($file)
	{
		// Leemos el fichero
		$txt = file_get_contents($file);
		
		// Times 12
		$this->SetFont('Times','',8);
		
		// Imprimimos el texto justificado
		$this->MultiCell(0,5,$txt);
		
		// Salto de línea
		$this->Ln();
		
		// Cita en itálica
		$this->SetFont('','I');
		$this->Cell(0,5,'(fin del extracto)');
	}

	function PrintChapter($num, $title, $file)
	{
		$this->AddPage();
		$this->ChapterTitle($num,$title);
		$this->ChapterBody($file);
	}

	function PrintChapterNoTitle($file)
	{
		$this->ChapterBody($file);
	}

	// Cargar los datos
	function LoadDataFile($file)
	{
		// Leer las líneas del fichero
		$lines = file($file);
		$data = array();
		foreach($lines as $line)
			$data[] = explode(';',trim($line));
		return $data;
	}

	// Tabla simple
	function BasicTable($header, $data)
	{
		// Cabecera
		foreach($header as $col)
			$this->Cell(40,7,$col,1);
		$this->Ln();
		// Datos
		foreach($data as $row)
		{
			foreach($row as $col)
				$this->Cell(40,6,$col,1);
			$this->Ln();
		}
	}

	// Una tabla más completa
	function ImprovedTable($header, $data)
	{
		// Anchuras de las columnas
		$w = array(40, 35, 45, 40);
		// Cabeceras
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],7,$header[$i],1,0,'C');
		$this->Ln();
		// Datos
		foreach($data as $row)
		{
			$this->Cell($w[0],6,$row[0],'LR');
			$this->Cell($w[1],6,$row[1],'LR');
			$this->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
			$this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
			$this->Ln();
		}
		// Línea de cierre
		$this->Cell(array_sum($w),0,'','T');
	}

	// Tabla coloreada
	function FancyTable($header, $data)
	{
		// Colores, ancho de línea y fuente en negrita
		$this->SetFillColor(255,0,0);
		$this->SetTextColor(255);
		$this->SetDrawColor(128,0,0);
		$this->SetLineWidth(.3);
		$this->SetFont('','B');
		// Cabecera
		$w = array(20, 18, 23, 20, 20, 20);
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
		$this->Ln();
		// Restauración de colores y fuentes
		$this->SetFillColor(224,235,255);
		$this->SetTextColor(0);
		$this->SetFont('');
		// Datos
		$fill = false;
		foreach($data as $row)
		{
			$this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
			$this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
			$this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
			$this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
			$this->Ln();
			$fill = !$fill;
		}
		// Línea de cierre
		$this->Cell(array_sum($w),0,'','T');
	}



	protected $T128;                                         // Tableau des codes 128
	protected $ABCset = "";                                  // jeu des caractères éligibles au C128
	protected $Aset = "";                                    // Set A du jeu des caractères éligibles
	protected $Bset = "";                                    // Set B du jeu des caractères éligibles
	protected $Cset = "";                                    // Set C du jeu des caractères éligibles
	protected $SetFrom;                                      // Convertisseur source des jeux vers le tableau
	protected $SetTo;                                        // Convertisseur destination des jeux vers le tableau
	protected $JStart = array("A"=>103, "B"=>104, "C"=>105); // Caractères de sélection de jeu au début du C128
	protected $JSwap = array("A"=>101, "B"=>100, "C"=>99);   // Caractères de changement de jeu

	//____________________________ Extension du constructeur _______________________
	function __construct($orientation='P', $unit='mm', $format='A4') {

		parent::__construct($orientation,$unit,$format);

		$this->T128[] = array(2, 1, 2, 2, 2, 2);           //0 : [ ]               // composition des caractères
		$this->T128[] = array(2, 2, 2, 1, 2, 2);           //1 : [!]
		$this->T128[] = array(2, 2, 2, 2, 2, 1);           //2 : ["]
		$this->T128[] = array(1, 2, 1, 2, 2, 3);           //3 : [#]
		$this->T128[] = array(1, 2, 1, 3, 2, 2);           //4 : [$]
		$this->T128[] = array(1, 3, 1, 2, 2, 2);           //5 : [%]
		$this->T128[] = array(1, 2, 2, 2, 1, 3);           //6 : [&]
		$this->T128[] = array(1, 2, 2, 3, 1, 2);           //7 : [']
		$this->T128[] = array(1, 3, 2, 2, 1, 2);           //8 : [(]
		$this->T128[] = array(2, 2, 1, 2, 1, 3);           //9 : [)]
		$this->T128[] = array(2, 2, 1, 3, 1, 2);           //10 : [*]
		$this->T128[] = array(2, 3, 1, 2, 1, 2);           //11 : [+]
		$this->T128[] = array(1, 1, 2, 2, 3, 2);           //12 : [,]
		$this->T128[] = array(1, 2, 2, 1, 3, 2);           //13 : [-]
		$this->T128[] = array(1, 2, 2, 2, 3, 1);           //14 : [.]
		$this->T128[] = array(1, 1, 3, 2, 2, 2);           //15 : [/]
		$this->T128[] = array(1, 2, 3, 1, 2, 2);           //16 : [0]
		$this->T128[] = array(1, 2, 3, 2, 2, 1);           //17 : [1]
		$this->T128[] = array(2, 2, 3, 2, 1, 1);           //18 : [2]
		$this->T128[] = array(2, 2, 1, 1, 3, 2);           //19 : [3]
		$this->T128[] = array(2, 2, 1, 2, 3, 1);           //20 : [4]
		$this->T128[] = array(2, 1, 3, 2, 1, 2);           //21 : [5]
		$this->T128[] = array(2, 2, 3, 1, 1, 2);           //22 : [6]
		$this->T128[] = array(3, 1, 2, 1, 3, 1);           //23 : [7]
		$this->T128[] = array(3, 1, 1, 2, 2, 2);           //24 : [8]
		$this->T128[] = array(3, 2, 1, 1, 2, 2);           //25 : [9]
		$this->T128[] = array(3, 2, 1, 2, 2, 1);           //26 : [:]
		$this->T128[] = array(3, 1, 2, 2, 1, 2);           //27 : [;]
		$this->T128[] = array(3, 2, 2, 1, 1, 2);           //28 : [<]
		$this->T128[] = array(3, 2, 2, 2, 1, 1);           //29 : [=]
		$this->T128[] = array(2, 1, 2, 1, 2, 3);           //30 : [>]
		$this->T128[] = array(2, 1, 2, 3, 2, 1);           //31 : [?]
		$this->T128[] = array(2, 3, 2, 1, 2, 1);           //32 : [@]
		$this->T128[] = array(1, 1, 1, 3, 2, 3);           //33 : [A]
		$this->T128[] = array(1, 3, 1, 1, 2, 3);           //34 : [B]
		$this->T128[] = array(1, 3, 1, 3, 2, 1);           //35 : [C]
		$this->T128[] = array(1, 1, 2, 3, 1, 3);           //36 : [D]
		$this->T128[] = array(1, 3, 2, 1, 1, 3);           //37 : [E]
		$this->T128[] = array(1, 3, 2, 3, 1, 1);           //38 : [F]
		$this->T128[] = array(2, 1, 1, 3, 1, 3);           //39 : [G]
		$this->T128[] = array(2, 3, 1, 1, 1, 3);           //40 : [H]
		$this->T128[] = array(2, 3, 1, 3, 1, 1);           //41 : [I]
		$this->T128[] = array(1, 1, 2, 1, 3, 3);           //42 : [J]
		$this->T128[] = array(1, 1, 2, 3, 3, 1);           //43 : [K]
		$this->T128[] = array(1, 3, 2, 1, 3, 1);           //44 : [L]
		$this->T128[] = array(1, 1, 3, 1, 2, 3);           //45 : [M]
		$this->T128[] = array(1, 1, 3, 3, 2, 1);           //46 : [N]
		$this->T128[] = array(1, 3, 3, 1, 2, 1);           //47 : [O]
		$this->T128[] = array(3, 1, 3, 1, 2, 1);           //48 : [P]
		$this->T128[] = array(2, 1, 1, 3, 3, 1);           //49 : [Q]
		$this->T128[] = array(2, 3, 1, 1, 3, 1);           //50 : [R]
		$this->T128[] = array(2, 1, 3, 1, 1, 3);           //51 : [S]
		$this->T128[] = array(2, 1, 3, 3, 1, 1);           //52 : [T]
		$this->T128[] = array(2, 1, 3, 1, 3, 1);           //53 : [U]
		$this->T128[] = array(3, 1, 1, 1, 2, 3);           //54 : [V]
		$this->T128[] = array(3, 1, 1, 3, 2, 1);           //55 : [W]
		$this->T128[] = array(3, 3, 1, 1, 2, 1);           //56 : [X]
		$this->T128[] = array(3, 1, 2, 1, 1, 3);           //57 : [Y]
		$this->T128[] = array(3, 1, 2, 3, 1, 1);           //58 : [Z]
		$this->T128[] = array(3, 3, 2, 1, 1, 1);           //59 : [[]
		$this->T128[] = array(3, 1, 4, 1, 1, 1);           //60 : [\]
		$this->T128[] = array(2, 2, 1, 4, 1, 1);           //61 : []]
		$this->T128[] = array(4, 3, 1, 1, 1, 1);           //62 : [^]
		$this->T128[] = array(1, 1, 1, 2, 2, 4);           //63 : [_]
		$this->T128[] = array(1, 1, 1, 4, 2, 2);           //64 : [`]
		$this->T128[] = array(1, 2, 1, 1, 2, 4);           //65 : [a]
		$this->T128[] = array(1, 2, 1, 4, 2, 1);           //66 : [b]
		$this->T128[] = array(1, 4, 1, 1, 2, 2);           //67 : [c]
		$this->T128[] = array(1, 4, 1, 2, 2, 1);           //68 : [d]
		$this->T128[] = array(1, 1, 2, 2, 1, 4);           //69 : [e]
		$this->T128[] = array(1, 1, 2, 4, 1, 2);           //70 : [f]
		$this->T128[] = array(1, 2, 2, 1, 1, 4);           //71 : [g]
		$this->T128[] = array(1, 2, 2, 4, 1, 1);           //72 : [h]
		$this->T128[] = array(1, 4, 2, 1, 1, 2);           //73 : [i]
		$this->T128[] = array(1, 4, 2, 2, 1, 1);           //74 : [j]
		$this->T128[] = array(2, 4, 1, 2, 1, 1);           //75 : [k]
		$this->T128[] = array(2, 2, 1, 1, 1, 4);           //76 : [l]
		$this->T128[] = array(4, 1, 3, 1, 1, 1);           //77 : [m]
		$this->T128[] = array(2, 4, 1, 1, 1, 2);           //78 : [n]
		$this->T128[] = array(1, 3, 4, 1, 1, 1);           //79 : [o]
		$this->T128[] = array(1, 1, 1, 2, 4, 2);           //80 : [p]
		$this->T128[] = array(1, 2, 1, 1, 4, 2);           //81 : [q]
		$this->T128[] = array(1, 2, 1, 2, 4, 1);           //82 : [r]
		$this->T128[] = array(1, 1, 4, 2, 1, 2);           //83 : [s]
		$this->T128[] = array(1, 2, 4, 1, 1, 2);           //84 : [t]
		$this->T128[] = array(1, 2, 4, 2, 1, 1);           //85 : [u]
		$this->T128[] = array(4, 1, 1, 2, 1, 2);           //86 : [v]
		$this->T128[] = array(4, 2, 1, 1, 1, 2);           //87 : [w]
		$this->T128[] = array(4, 2, 1, 2, 1, 1);           //88 : [x]
		$this->T128[] = array(2, 1, 2, 1, 4, 1);           //89 : [y]
		$this->T128[] = array(2, 1, 4, 1, 2, 1);           //90 : [z]
		$this->T128[] = array(4, 1, 2, 1, 2, 1);           //91 : [{]
		$this->T128[] = array(1, 1, 1, 1, 4, 3);           //92 : [|]
		$this->T128[] = array(1, 1, 1, 3, 4, 1);           //93 : [}]
		$this->T128[] = array(1, 3, 1, 1, 4, 1);           //94 : [~]
		$this->T128[] = array(1, 1, 4, 1, 1, 3);           //95 : [DEL]
		$this->T128[] = array(1, 1, 4, 3, 1, 1);           //96 : [FNC3]
		$this->T128[] = array(4, 1, 1, 1, 1, 3);           //97 : [FNC2]
		$this->T128[] = array(4, 1, 1, 3, 1, 1);           //98 : [SHIFT]
		$this->T128[] = array(1, 1, 3, 1, 4, 1);           //99 : [Cswap]
		$this->T128[] = array(1, 1, 4, 1, 3, 1);           //100 : [Bswap]                
		$this->T128[] = array(3, 1, 1, 1, 4, 1);           //101 : [Aswap]
		$this->T128[] = array(4, 1, 1, 1, 3, 1);           //102 : [FNC1]
		$this->T128[] = array(2, 1, 1, 4, 1, 2);           //103 : [Astart]
		$this->T128[] = array(2, 1, 1, 2, 1, 4);           //104 : [Bstart]
		$this->T128[] = array(2, 1, 1, 2, 3, 2);           //105 : [Cstart]
		$this->T128[] = array(2, 3, 3, 1, 1, 1);           //106 : [STOP]
		$this->T128[] = array(2, 1);                       //107 : [END BAR]

		for ($i = 32; $i <= 95; $i++) {                                            // jeux de caractères
			$this->ABCset .= chr($i);
		}
		$this->Aset = $this->ABCset;
		$this->Bset = $this->ABCset;
		
		for ($i = 0; $i <= 31; $i++) {
			$this->ABCset .= chr($i);
			$this->Aset .= chr($i);
		}
		for ($i = 96; $i <= 127; $i++) {
			$this->ABCset .= chr($i);
			$this->Bset .= chr($i);
		}
		for ($i = 200; $i <= 210; $i++) {                                           // controle 128
			$this->ABCset .= chr($i);
			$this->Aset .= chr($i);
			$this->Bset .= chr($i);
		}
		$this->Cset="0123456789".chr(206);

		for ($i=0; $i<96; $i++) {                                                   // convertisseurs des jeux A & B
			@$this->SetFrom["A"] .= chr($i);
			@$this->SetFrom["B"] .= chr($i + 32);
			@$this->SetTo["A"] .= chr(($i < 32) ? $i+64 : $i-32);
			@$this->SetTo["B"] .= chr($i);
		}
		for ($i=96; $i<107; $i++) {                                                 // contrôle des jeux A & B
			@$this->SetFrom["A"] .= chr($i + 104);
			@$this->SetFrom["B"] .= chr($i + 104);
			@$this->SetTo["A"] .= chr($i);
			@$this->SetTo["B"] .= chr($i);
		}
	}

	//________________ Fonction encodage et dessin du code 128 _____________________
	function Code128($x, $y, $code, $w, $h) {
		$Aguid = "";                                                                      // Création des guides de choix ABC
		$Bguid = "";
		$Cguid = "";
		for ($i=0; $i < strlen($code); $i++) {
			$needle = substr($code,$i,1);
			$Aguid .= ((strpos($this->Aset,$needle)===false) ? "N" : "O"); 
			$Bguid .= ((strpos($this->Bset,$needle)===false) ? "N" : "O"); 
			$Cguid .= ((strpos($this->Cset,$needle)===false) ? "N" : "O");
		}

		$SminiC = "OOOO";
		$IminiC = 4;

		$crypt = "";
		while ($code > "") {
																						// BOUCLE PRINCIPALE DE CODAGE
			$i = strpos($Cguid,$SminiC);                                                // forçage du jeu C, si possible
			if ($i!==false) {
				$Aguid [$i] = "N";
				$Bguid [$i] = "N";
			}

			if (substr($Cguid,0,$IminiC) == $SminiC) {                                  // jeu C
				$crypt .= chr(($crypt > "") ? $this->JSwap["C"] : $this->JStart["C"]);  // début Cstart, sinon Cswap
				$made = strpos($Cguid,"N");                                             // étendu du set C
				if ($made === false) {
					$made = strlen($Cguid);
				}
				if (fmod($made,2)==1) {
					$made--;                                                            // seulement un nombre pair
				}
				for ($i=0; $i < $made; $i += 2) {
					$crypt .= chr(strval(substr($code,$i,2)));                          // conversion 2 par 2
				}
				$jeu = "C";
			} else {
				$madeA = strpos($Aguid,"N");                                            // étendu du set A
				if ($madeA === false) {
					$madeA = strlen($Aguid);
				}
				$madeB = strpos($Bguid,"N");                                            // étendu du set B
				if ($madeB === false) {
					$madeB = strlen($Bguid);
				}
				$made = (($madeA < $madeB) ? $madeB : $madeA );                         // étendu traitée
				$jeu = (($madeA < $madeB) ? "B" : "A" );                                // Jeu en cours

				$crypt .= chr(($crypt > "") ? $this->JSwap[$jeu] : $this->JStart[$jeu]); // début start, sinon swap

				$crypt .= strtr(substr($code, 0,$made), $this->SetFrom[$jeu], $this->SetTo[$jeu]); // conversion selon jeu

			}
			$code = substr($code,$made);                                           // raccourcir légende et guides de la zone traitée
			$Aguid = substr($Aguid,$made);
			$Bguid = substr($Bguid,$made);
			$Cguid = substr($Cguid,$made);
		}                                                                          // FIN BOUCLE PRINCIPALE

		$check = ord($crypt[0]);                                                   // calcul de la somme de contrôle
		for ($i=0; $i<strlen($crypt); $i++) {
			$check += (ord($crypt[$i]) * $i);
		}
		$check %= 103;

		$crypt .= chr($check) . chr(106) . chr(107);                               // Chaine cryptée complète

		$i = (strlen($crypt) * 11) - 8;                                            // calcul de la largeur du module
		$modul = $w/$i;

		for ($i=0; $i<strlen($crypt); $i++) {                                      // BOUCLE D'IMPRESSION
			$c = $this->T128[ord($crypt[$i])];
			for ($j=0; $j<count($c); $j++) {
				$this->Rect($x,$y,$c[$j]*$modul,$h,"F");
				$x += ($c[$j++]+$c[$j])*$modul;
			}
		}
	}
}


if(isset($_GET['refQuotations']))
{
	$idQuotations = (int) $_GET['refQuotations'];
	
	try {
		$sql = "SELECT 
			quotations_clients.id AS quotations_id
			, clients.social_reason AS client_full_name
			, geo_departments.name AS department
			, geo_citys.name AS city 
			, quotations_clients.id AS quotation_number
			, accounts_clients.name AS proyect_name
			, accounts_clients.create AS account_create
			, accounts_clients.update AS account_update
			, quotations_clients.create AS quotations_clients_create
			, quotations_clients.update AS quotations_clients_update 
			, quotations_clients.values AS listvalues
			, quotations_clients.validity AS validity
			, contacts.first_name AS contact_first_name
			, contacts.second_name AS contact_second_name
			, contacts.surname AS contact_surname 
			, contacts.second_surname AS contact_second_surname
			, config_options.result AS resultBodyText
			
			FROM quotations_clients 
			LEFT JOIN accounts_clients 
				ON quotations_clients.account = accounts_clients.id 
			LEFT JOIN clients 
				ON quotations_clients.client = clients.id 
			LEFT JOIN geo_departments
				ON clients.department = geo_departments.id 
			LEFT JOIN geo_citys
				ON clients.city = geo_citys.id 
			LEFT JOIN contacts 
				ON accounts_clients.contact = contacts.id 
			LEFT JOIN config_options 
				ON config_options.name IN ('proposalLetter')
			WHERE quotations_clients.id='{$idQuotations}' ;";
			
		$conn = new PDO("mysql:host=" . HOST_DB . ";port=8889;dbname=" . NAME_DB, USER_DB, PASS_DB); 
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conn->exec("SET CHARACTER SET utf8; SET COLLATION SET utf8_unicode_ci");
		$stmt = $conn->prepare($sql); 
		$stmt->execute();

		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$result = new RecursiveArrayIterator($stmt->fetchAll());
		
		if(isset($result[0]['quotations_id'])){
			$infoData = $result[0];
			$infoData['listvalues'] = @json_decode($infoData['listvalues']);
			#$fgsta = json_decode($infoData['listvalues'], JSON_HEX_QUOT);
		
			$label_services = array();
			foreach($infoData['listvalues']->services as $service){
				$label_services[] = ucwords(strtolower(utf8_decode($service->service->name)));
			}

			$QC_resultBodyText = utf8_decode($infoData['resultBodyText']);
			$QC_ProyectName = utf8_decode($infoData['proyect_name']);
			$QC_NumberRef = str_pad($infoData['quotations_id'], 11, "0", STR_PAD_LEFT);
			$QC_years_total = TOTAL_YEARS;
			$QC_LabelsServices = (@implode(', ', $label_services));
			$QC_FullName = utf8_decode($infoData['client_full_name']);
			$QC_FullContact = utf8_decode($infoData['contact_first_name'] . ' ' . $infoData['contact_second_name'] . ' ' . $infoData['contact_surname'] . ' ' . $infoData['contact_second_surname']);
			$QC_Department = ucwords(strtolower(utf8_decode($infoData['department'])));
			$QC_City = ucwords(strtolower(utf8_decode($infoData['city'])));
			$datetime = new DateTime($infoData['quotations_clients_create']);
			$QC_create = $datetime;
			$QC_create_day = $datetime->format('d');
			$QC_create_month = $datetime->format('F');
			$QC_create_month_spanish = str_ireplace($nmeng, $nmtur, $QC_create_month);
			$QC_create_year = $datetime->format('Y');
			$QC_validity = $infoData['validity'];
			
			
			$currentDate = new DateTime('now');
			$date1 = $currentDate;
			$date2 = $QC_create;
			$compareDate = $date1->diff($date2);
			
			
			
			#echo json_encode($infoData);
			# Crear PDF
			#$pdf = new PDF();
			
			#$pdf = new PDF_Code128('P','mm','A4');
			$pdf = new PDF('P','mm','A4');
			$title = "Propuesta: {$QC_NumberRef} - Servicios Ambientales Y Forestales Monteverde LTDA";
			$pdf->SetTitle($title);
			$pdf->SetAuthor('Creado por CMR - Monteverde LTDA - FelipheGomez');
			
			
			
			
			
			
			
			
			
			if($compareDate->days > $QC_validity)
			{
				
				# Pagina 2
				$pdf->AddPage('P');
				$pdf->Code128(10,25, $QC_NumberRef,60,20);
				
				
				$pdf->Ln(5);
				$header = array('CIUDAD', $QC_City.', '.$QC_Department, 'FECHA', $QC_create->format('Y-m-d'));
				$w = array(105, 15, 30, 15, 25);
				
				
				$pdf->Cell($w[0],8,'',0,0,'C', false);
						$pdf->SetFont('Arial','B',8);
						$pdf->SetFillColor(145,175,73);
						$pdf->SetTextColor(255);
						$pdf->SetDrawColor(100,121,50);
						$pdf->SetLineWidth(0.3);
				$pdf->Cell($w[1],8,$header[0],1,0,'C', true);
						$pdf->SetFont('Arial','',8);
						$pdf->SetFillColor(224,235,255);
						$pdf->SetTextColor(0);
						$pdf->SetLineWidth(0.3);
				$pdf->Cell($w[2],8,$header[1],1,0,'C', false);
						$pdf->SetFont('Arial','B',8);
						$pdf->SetFillColor(145,175,73);
						$pdf->SetTextColor(255);
						$pdf->SetDrawColor(100,121,50);
						$pdf->SetLineWidth(0.3);
				$pdf->Cell($w[3],8,$header[2],1,0,'C', true);
						$pdf->SetFont('Arial','',8);
						$pdf->SetFillColor(224,235,255);
						$pdf->SetTextColor(0);
						$pdf->SetLineWidth(0.3);
				$pdf->Cell($w[4],8,$header[3],1,0,'C', false);
		
				$pdf->Ln(15);
				$header = array('REF', $QC_NumberRef);
				$w = array(20, 40);
				$wTotal = 0;
				$fill = true;
				for($i=0;$i<count($header);$i++){
					if($fill == false){
						$pdf->SetFont('Arial','B',9);
						$pdf->SetFillColor(224,235,255);
						$pdf->SetTextColor(0);
						$pdf->SetLineWidth(0.3);
					}else{
						$pdf->SetFont('Arial','B',9);
						$pdf->SetFillColor(145,175,73);
						$pdf->SetTextColor(255);
						$pdf->SetDrawColor(100,121,50);
						$pdf->SetLineWidth(0.3);
					}
					$pdf->Cell($w[$i],7,$header[$i],1,0,'C',$fill);
					$wTotal = $wTotal + $w[$i];
					$fill = !$fill;
				}
				$pdf->Ln();
				// Línea de cierre
				$pdf->Cell(array_sum($w),0,'','T');
				$pdf->Ln(2);
				
				
				$pdf->Ln(2);
				$pdf->SetFont('Arial','',8);
				$pdf->SetTextColor(0);
				$pdf->MultiCell(0, 5, "Lo sentimos, esta propuesta tiene una vigencia por {$infoData['validity']} días y ya ha expirado, Comunicate con nosotros para obtener más informacion sobre una una nueva propuesta o utiliza los enlaces de la parte inferior.");
				$pdf->Ln(3);
				
				
				// Arial bold 15
				$pdf->SetFont('Arial','B',7);
				// Colores de los bordes, fondo y texto
				$pdf->SetFillColor(145,175,73);
				$pdf->SetTextColor(255);
				$pdf->SetDrawColor(100,121,50);
				
				// Título
				$pdf->Cell(0,7,'DETALLE DE LA PROPUESTA',1,1,'C',true);
				$pdf->Ln(2);
				
				
				
				// Colores, ancho de línea y fuente en negrita
				$pdf->SetFillColor(145,175,73);
				$pdf->SetTextColor(255);
				$pdf->SetDrawColor(100,121,50);
				$pdf->SetLineWidth(.3);
				$pdf->SetFont('','B');
				$pdf->SetFont('Arial','B',6);
				// Cabecera
				$header = array('CONCEPTO', 'CANT', 'U. MED', 'V. UNI', 'FREC', 'IVA', 'SUBTOTAL', 'TOTAL');
				$w = array(62, 10, 10, 22, 32, 10, 22, 22);
				$wTotal = 0;
				for($i=0;$i<count($header);$i++){
					$pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
					$wTotal = $wTotal + $w[$i];
				}
				$pdf->Ln();
				// Restauración de colores y fuentes
				$pdf->SetFillColor(224,235,255);
				$pdf->SetTextColor(0);
				$pdf->SetFont('');
				$pdf->SetFont('Arial','',6);
				$pdf->SetLineWidth(0.3);
				
				// Servicios
				$fill = false;
				$TotalIva = 0;
				$TotalQou = 0;
				$SubTotalQou = 0;
				foreach($infoData['listvalues']->services as $row)
				{
					$subtotal = ($row->service->price * $row->quantity);
					$total = ($row->service->price * $row->quantity) + (($row->service->price * $row->quantity) * ($row->iva / 100));
					$pdf->Cell($w[0],6,ucwords(strtolower(utf8_decode($row->service->name))),'LR', 0,'L',$fill);
					$pdf->Cell($w[1],6,$row->quantity,'LR',0,'C',$fill);
					$pdf->Cell($w[2],6,$row->service->type_medition->code,'LR',0,'C',$fill);
					$pdf->Cell($w[3],6, '-','LR',0,'C',$fill);
					$pdf->Cell($w[4],6,$row->repeat->name,'LR',0,'C',$fill);
					$pdf->Cell($w[5],6,$row->iva.'%','LR',0,'C',$fill);
					$pdf->Cell($w[6],6, '-','LR',0,'C',$fill);
					$pdf->Cell($w[7],6, '-','LR',0,'C',$fill);
					$pdf->Ln();
					#$pdf->MultiCell($wTotal,6,utf8_decode($row->service->description), 1,'J',$fill);
					$fill = !$fill;
					$TotalQou = $TotalQou + $total;
					$SubTotalQou = $SubTotalQou + $subtotal;
					$TotalIva = $TotalIva + ($total - $subtotal);
				}
				
				$w2Total = 0;
				for($i=0;$i<count($header);$i++){
					$w2Total = $w2Total + $w[$i];
				}
				// Restauración de colores y fuentes
				$pdf->SetFillColor(224,235,255);
				$pdf->SetTextColor(0);
				$pdf->SetFont('');
				$pdf->SetFont('Arial','',6);
				$pdf->SetLineWidth(0.3);
				
				// Otros
				$fill = false;
				foreach($infoData['listvalues']->attributes as $row)
				{
					$subtotal = ($row->attribute->price * $row->quantity);
					$total = ($row->attribute->price * $row->quantity) + (($row->attribute->price * $row->quantity) * ($row->iva / 100));
					$pdf->Cell($w[0],6,ucwords(strtolower(utf8_decode($row->attribute->name))),'LR', 0,'L',$fill);
					$pdf->Cell($w[1],6,$row->quantity,'LR',0,'C',$fill);
					$pdf->Cell($w[2],6,'','LR',0,'C',$fill);
					$pdf->Cell($w[3],6, '-','LR',0,'C',$fill);
					$pdf->Cell($w[4],6,'','LR',0,'C',$fill);
					$pdf->Cell($w[5],6,$row->iva.'%','LR',0,'C',$fill);
					$pdf->Cell($w[6],6, '-','LR',0,'C',$fill);
					$pdf->Cell($w[7],6, '-','LR',0,'C',$fill);
					$pdf->Ln();
					#$pdf->MultiCell($w2Total,6,utf8_decode($row->attribute->description),1,'L',$fill);
					$fill = !$fill;
					$TotalQou = $TotalQou + $total;
					$SubTotalQou = $SubTotalQou + $subtotal;
					$TotalIva = $TotalIva + ($total - $subtotal);
				}
				$pdf->Cell(array_sum($w),0,'','T');
				$pdf->Ln(2);
				
				
				// Arial bold 15
				$pdf->SetFont('Arial','B',9);
				// Colores de los bordes, fondo y texto
				$pdf->SetFillColor(255);
				$pdf->SetTextColor(145,175,73);
				$pdf->SetDrawColor(255);
				
				// Título
				$pdf->Cell(0,7,'¿QUIERES UNA NUEVA PROPUESTA?',0,1,'L',true);
				$pdf->Ln(2);
				$pdf->SetFont('Arial','B',8);	$pdf->SetTextColor(145,175,73);	$pdf->Cell(0,6,'Generar Propuesta Automaticamente',0,1,'L',true);
				$pdf->SetFont('Arial','',8);	$pdf->SetTextColor(0);			$pdf->Cell(0,6,'#',0,1,'L',true);
				$pdf->Ln();
				$pdf->SetFont('Arial','B',8);	$pdf->SetTextColor(145,175,73);	$pdf->Cell(0,6,'Email',0,1,'L',true);
				$pdf->SetFont('Arial','',8);	$pdf->SetTextColor(0);			$pdf->Cell(0,6,'atencionalcliente@monteverdeltda.com',0,1,'L',true);
				$pdf->Ln();
				$pdf->SetFont('Arial','B',8);	$pdf->SetTextColor(145,175,73);	$pdf->Cell(0,6,'Telefonos',0,1,'L',true);
				$pdf->SetFont('Arial','',8);	$pdf->SetTextColor(0);			$pdf->Cell(0,6,'413 90 26',0,1,'L',true);
				$pdf->Ln();
				$pdf->SetFont('Arial','B',8);	$pdf->SetTextColor(145,175,73);	$pdf->Cell(0,6,'Página Web',0,1,'L',true);
				$pdf->SetFont('Arial','',8);	$pdf->SetTextColor(0);			$pdf->Cell(0,6,'http://monteverdeltda.com',0,1,'L',true);
				$pdf->Ln();
			}
			else{
				# Pagina # 1 ---------------------------- CARTA DE SALUDO # Pagina 1
				$wellcome = false;
				if(isset($_GET['wellcome'])){
					if($_GET['wellcome'] == 'false'){
						$wellcome = false;
					}else{
						$wellcome = true;
					}
				}
				else { $wellcome = true; }
				
				if($wellcome === true){
					$pdf->AddPage();
					$pdf->SetFont('Arial', '', 10);
					
					$values_origin = array(
						'{ProyectName}'
						, '{NumberRef}'
						, '{YearsCompany}'
						, '{LabelsServices}'
						, '{FullNameClient}'
						, '{ContactFullName}'
						, '{DepartmentClient}'
						, '{CityClient}'
						, '{dayCreate}'
						, '{monthCreate}'
						, '{yearCreate}'
					);
					$values_change = array(
						$QC_ProyectName
						, $QC_NumberRef
						, $QC_years_total
						, $QC_LabelsServices
						, $QC_FullName
						, $QC_FullContact
						, $QC_Department
						, $QC_City
						, $QC_create_day
						, $QC_create_month_spanish
						, $QC_create_year
					);
					$bodyText = $QC_resultBodyText;
					$bodyText = str_ireplace($values_origin, $values_change, ($bodyText));
					
					$pdf->MultiCell(0, 7, $bodyText);
					$pdf->Ln();
					$pdf->Ln();
					$pdf->MultiCell(0, 7, '__________________________________');
					$pdf->SetFont('Arial', 'B', 10);
					$pdf->MultiCell(0, 5, 'LIZ MARYORI TREJOS');
					$pdf->SetFont('Arial', '', 10);
					$pdf->MultiCell(0, 5, 'Analista Comercial');
					$pdf->MultiCell(0, 5, 'Servicios Ambientales y Forestales Monteverde LTDA');
					$pdf->Ln(5);
				}
				
				# Pagina 2
				$pdf->AddPage('P');
				$pdf->Code128(10,25, $QC_NumberRef,60,20);
				
				
				$pdf->Ln(5);
				$header = array('CIUDAD', $QC_City.', '.$QC_Department, 'FECHA', $QC_create->format('Y-m-d'));
				$w = array(105, 15, 30, 15, 25);
				
				
				$pdf->Cell($w[0],8,'',0,0,'C', false);
						$pdf->SetFont('Arial','B',8);
						$pdf->SetFillColor(145,175,73);
						$pdf->SetTextColor(255);
						$pdf->SetDrawColor(100,121,50);
						$pdf->SetLineWidth(0.3);
				$pdf->Cell($w[1],8,$header[0],1,0,'C', true);
						$pdf->SetFont('Arial','',8);
						$pdf->SetFillColor(224,235,255);
						$pdf->SetTextColor(0);
						$pdf->SetLineWidth(0.3);
				$pdf->Cell($w[2],8,$header[1],1,0,'C', false);
						$pdf->SetFont('Arial','B',8);
						$pdf->SetFillColor(145,175,73);
						$pdf->SetTextColor(255);
						$pdf->SetDrawColor(100,121,50);
						$pdf->SetLineWidth(0.3);
				$pdf->Cell($w[3],8,$header[2],1,0,'C', true);
						$pdf->SetFont('Arial','',8);
						$pdf->SetFillColor(224,235,255);
						$pdf->SetTextColor(0);
						$pdf->SetLineWidth(0.3);
				$pdf->Cell($w[4],8,$header[3],1,0,'C', false);
		
				$pdf->Ln(15);
				$header = array('REF', $QC_NumberRef);
				$w = array(20, 40);
				$wTotal = 0;
				$fill = true;
				for($i=0;$i<count($header);$i++){
					if($fill == false){
						$pdf->SetFont('Arial','B',9);
						$pdf->SetFillColor(224,235,255);
						$pdf->SetTextColor(0);
						$pdf->SetLineWidth(0.3);
					}else{
						$pdf->SetFont('Arial','B',9);
						$pdf->SetFillColor(145,175,73);
						$pdf->SetTextColor(255);
						$pdf->SetDrawColor(100,121,50);
						$pdf->SetLineWidth(0.3);
					}
					$pdf->Cell($w[$i],7,$header[$i],1,0,'C',$fill);
					$wTotal = $wTotal + $w[$i];
					$fill = !$fill;
				}
				$pdf->Ln();
				// Línea de cierre
				$pdf->Cell(array_sum($w),0,'','T');
				$pdf->Ln(2);
				
				// Arial bold 15
				$pdf->SetFont('Arial','B',7);
				// Colores de los bordes, fondo y texto
				$pdf->SetFillColor(145,175,73);
				$pdf->SetTextColor(255);
				$pdf->SetDrawColor(100,121,50);
				
				// Título
				$pdf->Cell(0,7,'DETALLE DE LA PROPUESTA',1,1,'C',true);
				$pdf->Ln(2);
				
				// Colores, ancho de línea y fuente en negrita
				$pdf->SetFillColor(145,175,73);
				$pdf->SetTextColor(255);
				$pdf->SetDrawColor(100,121,50);
				$pdf->SetLineWidth(.3);
				$pdf->SetFont('','B');
				$pdf->SetFont('Arial','B',6);
				// Cabecera
				$header = array('CONCEPTO', 'CANT', 'U. MED', 'V. UNI', 'FREC', 'IVA', 'SUBTOTAL', 'TOTAL');
				$w = array(62, 10, 10, 22, 32, 10, 22, 22);
				$wTotal = 0;
				for($i=0;$i<count($header);$i++){
					$pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
					$wTotal = $wTotal + $w[$i];
				}
				$pdf->Ln();
				// Restauración de colores y fuentes
				$pdf->SetFillColor(224,235,255);
				$pdf->SetTextColor(0);
				$pdf->SetFont('');
				$pdf->SetFont('Arial','',6);
				$pdf->SetLineWidth(0.3);
				
				// Servicios
				$fill = false;
				$TotalIva = 0;
				$TotalQou = 0;
				$SubTotalQou = 0;
				foreach($infoData['listvalues']->services as $row)
				{
					$subtotal = ($row->service->price * $row->quantity);
					$total = ($row->service->price * $row->quantity) + (($row->service->price * $row->quantity) * ($row->iva / 100));
					$pdf->Cell($w[0],6,ucwords(strtolower(utf8_decode($row->service->name))),'LR', 0,'L',$fill);
					$pdf->Cell($w[1],6,$row->quantity,'LR',0,'C',$fill);
					$pdf->Cell($w[2],6,$row->service->type_medition->code,'LR',0,'C',$fill);
					$pdf->Cell($w[3],6,money_format("%.2n", $row->service->price),'LR',0,'R',$fill);
					$pdf->Cell($w[4],6,$row->repeat->name,'LR',0,'C',$fill);
					$pdf->Cell($w[5],6,$row->iva.'%','LR',0,'C',$fill);
					$pdf->Cell($w[6],6, money_format("%.2n", $subtotal),'LR',0,'R',$fill);
					$pdf->Cell($w[7],6,money_format("%.2n", $total),'LR',0,'R',$fill);
					$pdf->Ln();
					#$pdf->MultiCell($wTotal,6,utf8_decode($row->service->description), 1,'J',$fill);
					$fill = !$fill;
					$TotalQou = $TotalQou + $total;
					$SubTotalQou = $SubTotalQou + $subtotal;
					$TotalIva = $TotalIva + ($total - $subtotal);
				}
				
				$w2Total = 0;
				for($i=0;$i<count($header);$i++){
					$w2Total = $w2Total + $w[$i];
				}
				// Restauración de colores y fuentes
				$pdf->SetFillColor(224,235,255);
				$pdf->SetTextColor(0);
				$pdf->SetFont('');
				$pdf->SetFont('Arial','',6);
				$pdf->SetLineWidth(0.3);
				
				// Otros
				$fill = false;
				foreach($infoData['listvalues']->attributes as $row)
				{
					$subtotal = ($row->attribute->price * $row->quantity);
					$total = ($row->attribute->price * $row->quantity) + (($row->attribute->price * $row->quantity) * ($row->iva / 100));
					$pdf->Cell($w[0],6,((utf8_decode($row->attribute->name))),'LR', 0,'L',$fill);
					$pdf->Cell($w[1],6,$row->quantity,'LR',0,'C',$fill);
					$pdf->Cell($w[2],6,'','LR',0,'C',$fill);
					$pdf->Cell($w[3],6,money_format("%.2n", $row->attribute->price),'LR',0,'R',$fill);
					$pdf->Cell($w[4],6,'','LR',0,'C',$fill);
					$pdf->Cell($w[5],6,$row->iva.'%','LR',0,'C',$fill);
					$pdf->Cell($w[6],6,money_format("%.2n", $subtotal),'LR',0,'R',$fill);
					$pdf->Cell($w[7],6,money_format("%.2n", $total),'LR',0,'R',$fill);
					$pdf->Ln();
					#$pdf->MultiCell($w2Total,6,utf8_decode($row->attribute->description),1,'L',$fill);
					$fill = !$fill;
					$TotalQou = $TotalQou + $total;
					$SubTotalQou = $SubTotalQou + $subtotal;
					$TotalIva = $TotalIva + ($total - $subtotal);
				}
				$pdf->Cell(array_sum($w),0,'','T');
				$pdf->Ln(2);
				
				$header = array('SUBTOTAL', money_format("%.2n",$SubTotalQou));
				$w = array(121, 25, 44);
				$pdf->SetLineWidth(0.3);
				$pdf->Cell($w[0],8,'',0,0,'R', false);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->SetFillColor(145,175,73);
				$pdf->SetTextColor(255);
				$pdf->SetDrawColor(100,121,50);
				$pdf->Cell($w[1],8,$header[0],1,0,'C',true);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->SetFillColor(100,121,50);
				$pdf->SetTextColor(0);
				$pdf->Cell($w[2],8,$header[1],1,0,'C', false);
				
				$pdf->Ln();
				$ivaT = round((($TotalQou / $SubTotalQou) - 1) * 100, 5, PHP_ROUND_HALF_EVEN);
				#$header = array('IVA', $ivaT.' %');
				$header = array('IVA', money_format("%.2n",$TotalIva));
				$w = array(121, 25, 44);
				$pdf->SetLineWidth(0.3);
				$pdf->Cell($w[0],8,'',0,0,'R', false);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->SetFillColor(145,175,73);
				$pdf->SetTextColor(255);
				$pdf->Cell($w[1],8,$header[0],1,0,'C',true);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->SetFillColor(100,121,50);
				$pdf->SetTextColor(0);
				$pdf->Cell($w[2],8,$header[1],1,0,'C', false);
				
				
				$pdf->Ln();
				$header = array('TOTAL', money_format("%.2n",$TotalQou));
				$w = array(121, 25, 44);
				$pdf->SetLineWidth(0.3);
				$pdf->Cell($w[0],8,'',0,0,'R', false);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->SetFillColor(145,175,73);
				$pdf->SetTextColor(255);
				$pdf->Cell($w[1],8,$header[0],1,0,'C',true);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->SetFillColor(100,121,50);
				$pdf->SetTextColor(0);
				$pdf->Cell($w[2],8,$header[1],1,0,'C', false);
				
				
				
				
				$pdf->Ln(2);
				$pdf->SetFont('Arial','',8);
				$pdf->SetTextColor(0);
				$pdf->MultiCell(0, 5, "La propuesta anterior tiene vigencia por {$infoData['validity']} días.");
				$pdf->Ln(3);
				
				
				$conn = new PDO("mysql:host=" . HOST_DB . ";port=8889;dbname=" . NAME_DB, USER_DB, PASS_DB); 
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$conn->exec("SET CHARACTER SET utf8; SET COLLATION SET utf8_unicode_ci");
				$stmt = $conn->prepare("SELECT * FROM config_options WHERE name IN ('TermsAndConditions')"); 
				$stmt->execute();
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				$result = new RecursiveArrayIterator($stmt->fetchAll());
				if(isset($result[0]['name'])){
					$pdf->SetLineWidth(0.1);
					$pdf->SetFillColor(255);
					$pdf->SetDrawColor(0);
					$pdf->SetTextColor(255);
					
					$pdf->SetFont('Arial','', 6);
					$pdf->SetTextColor(0);
					$pdf->MultiCell(0, 3, utf8_decode($result[0]['result']), 1, 'J', true);
					$pdf->Ln(5);
				}
				#$pdf->Code128(122,170, $QC_NumberRef,165,20);
				
				/*
				$pdf2=new PDF_Code128();
				$pdf2->AddPage();
				$pdf2->SetFont('Arial','',8);

				//A set
				$code='CODE 128';
				$pdf2->Code128(50,20,$code,80,20);
				$pdf2->SetXY(50,45);
				$pdf2->Write(5,'A set: "'.$code.'"');

				//B set
				$code='Code 128';
				$pdf2->Code128(50,70,$code,80,20);
				$pdf2->SetXY(50,95);
				$pdf2->Write(5,'B set: "'.$code.'"');

				//C set
				$code='12345678901234567890';
				$pdf2->Code128(50,120,$code,110,20);
				$pdf2->SetXY(50,145);
				$pdf2->Write(5,'C set: "'.$code.'"');

				//A,C,B sets
				$code='ABCDEFG1234567890AbCdEf';
				$pdf->Code128(50,170,$code,125,20);
				$pdf2->SetXY(50,195);
				$pdf2->Write(5,'ABC sets combined: "'.$code.'"');
				
				$pdf->AddPage();
				$pdf->SetFont('Arial','',8);
				$pdf->Ln(10);
				$pdf->Cell(0, 1, " =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=- ",0,1,'C');
				$pdf->Ln(5);
				$pdf->MultiCell(0, 5, base64_encode(json_encode($infoData)));
				$pdf->Ln(5);
				$pdf->Cell(0, 1, " =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=- ",0,1,'C');
				*/
			}
			
		
			$pdf->Output();
			
		}
	}
	catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	$conn = null;
}
else
{
	echo 'Upss';
}
?>
