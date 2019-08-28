<?php

Class CartService{

    public function cart($uid)
    {
        return'<div class="right">
				    <form action="proce.php">
				     <input type="submit"  class="buy" value="结算" />
				     </input>
				     <span class="close">
				       购<br/>
				       物<br/>
				       车
				     </span>
				    </form>
				</div>';
    }


}

