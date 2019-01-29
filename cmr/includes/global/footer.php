
				<footer class="sticky-footer">
					<div class="container my-auto">
						<div class="copyright text-center my-auto">
							<span>Copyright <?php echo title_md; ?> © FelipheGomez 2019</span>
							<?php 
								$betaSession = new Session();
							?>
							<span><?php echo json_encode($betaSession); ?></span>
						</div>
					</div>
				</footer>