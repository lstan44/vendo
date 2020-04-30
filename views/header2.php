<?php


print <<<EOF

<header id = "header2" >
<nav>
<ul>
<li> Header2 </li>
</ul>

<form method="POST" action="logout.php" >
<button type="submit"> Logout </button>
</form>


<form method="POST" action="search.php">
<input type="text" placeholder="search for item.." name="search_box"/>
<input type="submit"/>
</form>

</nav>
</header>

EOF;