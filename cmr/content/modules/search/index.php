
<div class="container">
	<div class="row">
	    <div class="col-12"><h2>Text Box Search icon</h2></div>
	    <div class="col-12">
    	    <div id="custom-search-input">
                <div class="input-group">
                    <input type="text" class="search-query form-control" placeholder="Search" />
                    <span class="input-group-btn">
                        <button type="button" disabled>
                            <span class="fa fa-search"></span>
                        </button>
                    </span>
                </div>
            </div>
        </div>
	</div>
</div>


<style>
.container{
    padding: 10%;
    text-align: center;
}
#custom-search-input {
    margin:0;
    margin-top: 10px;
    padding: 0;
}
 
#custom-search-input .search-query {
    width:100%;
    padding-right: 3px;
    padding-left: 15px;
        /* IE7-8 doesn't have border-radius, so don't indent the padding */
    margin-bottom: 0;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 0;
}
 
#custom-search-input button {
    border: 0;
    background: none;
    /** belows styles are working good */
    padding: 2px 5px;
    margin-top: 2px;
    position: absolute;
    right:0;
    /* IE7-8 doesn't have border-radius, so don't indent the padding */
    margin-bottom: 0;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    color:#D9230F;
    cursor: unset;
    z-index: 2;
}
 
.search-query:focus{
    z-index: 0;   
}

</style>