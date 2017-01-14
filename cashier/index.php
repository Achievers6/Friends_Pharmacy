
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Adjustable Pie Chart</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  
      <style>
      /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
      @import url(http://fonts.googleapis.com/css?family=Open+Sans:400,700);
@keyframes bake-pie {
  from {
    transform: rotate(0deg) translate3d(0, 0, 0);
  }
}
body {
  font-family: "Open Sans", Arial;
  background-color: #F1FE9;
}

main {
  width: 90%;
  margin: 30px auto;
}

section {
  margin-top: 30px;
}

.pieID {
  display: inline-block;
  vertical-align: top;
}

.pie {
  height: 200px;
  width: 200px;
  position: relative;
  margin: 0 30px 30px 0;
}

.pie::before {
  content: "";
  display: block;
  position: absolute;
  z-index: 1;
  width: 100px;
  height: 100px;
  background: #EEE;
  border-radius: 50%;
  top: 50px;
  left: 50px;
}

.pie::after {
  content: "";
  display: block;
  width: 120px;
  height: 2px;
  background: rgba(0, 0, 0, 0.1);
  border-radius: 50%;
  box-shadow: 0 0 3px 4px rgba(0, 0, 0, 0.1);
  margin: 220px auto;
}

.slice {
  position: absolute;
  width: 200px;
  height: 200px;
  clip: rect(0px, 200px, 200px, 100px);
  animation: bake-pie 1s;
}

.slice span {
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  background-color: black;
  width: 200px;
  height: 200px;
  border-radius: 50%;
  clip: rect(0px, 200px, 200px, 100px);
}

.legend {
  list-style-type: none;
  padding: 0;
  margin: 0;
  background: #FFF;
  padding: 15px;
  font-size: 13px;
  box-shadow: 1px 1px 0 #DDD, 2px 2px 0 #BBB;
}

.legend li {
  width: 150px;
  height: 1.25em;
  margin-bottom: 0.7em;
  padding-left: 0.5em;
  border-left: 1.25em solid black;
}

.legend em {
  font-style: normal;
}

.legend span {
  float: right;
}

footer {
  position: fixed;
  bottom: 0;
  right: 0;
  font-size: 13px;
  background: #DDD;
  padding: 5px 10px;
  margin: 5px;
}

    </style>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

</head>

<body>
     
			
			
    
  <main>
  <h1>Cashier Sales Graph Report</h1>
  
  <section>
    <div class="pieID pie">
      
    </div>
    <ul class="pieID legend">
        
    <?php
	
	
	foreach($name as $keys => $values)
    {
		?>
		<li>
        <em><?php echo $values;?></em>
        <span><?php echo $price[$keys];?></span>
        </li>
		
		 
		
		
		<?php
	}
	
	?>
    
	 <!-- 
	 for(){
	 <li>
        <em>$name</em>
        <span>$value</span>
     </li>
	 }
	  
      <li>
        <em>panadol</em>
        <span>718</span>
      </li>
      <li>
        <em>amoxciline</em>
        <span>531</span>
      </li>
      <li>
        <em>pititon</em>
        <span>868</span>
      </li>
      <li>
        <em>vitamin c</em>
        <span>344</span>
      </li>
      <li>
        <em>petromicing</em>
        <span>1145</span>
      </li>
    </ul>-->
  </section>
 
  
  
</main>

<footer>

</footer>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>

</body>
</html>
