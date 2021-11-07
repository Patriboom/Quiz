<?php if (strstr($_SERVER['PHP_SELF'], 'outils/') != '' ) { ?> <script type="text/javascript" >document.location.href = "../"; </script> <?php } ?>
<form name="Questionne" id="FormQuestionne" action="index.php?mod=<?php echo $_GET["mod"].'&fct='.$_GET["fct"]; ?>" method="POST" <?php echo (isset($TypeForm)) ? 'enctype="'.$TypeForm.'"' : ''; ?> >
