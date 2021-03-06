<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>budgetIncome</title>
    <link href="../css/smart_tab.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../css/style.css"/>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/jquery.smartTab.js"></script>
    
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" >
	<!-- 這3行引進左右滑動畫面 -->
	 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	
	<style type="text/css">
		        
		@charset "utf-8";
			body{
			overflow:visible;
				background-size:cover;
				text-align:center;
			}
			table{
				border-style:single;
				border-width:5px;
				border-color:000000;
				-webkit-border-radius: 10px;
				color:#000;
				font-family:微軟正黑體,Ariel;
				text-align: center;
			}
			
			@media screen and (max-width: 768px) {

				#budgetsub{
					font-size: 15px;
				}
				table{
					font-size: 1px;
				}
			}
			
		
		</style>
  </head>
  
 <body>
	<div id="container">
      <div class="panel panel-success">
       <div class="panel-heading"><h1 body style="color:#6666FF;" id="budgetsub">預算報表檢視
        <font size="2" color="#ff3030" style="font-family:'Comic Sans MS', cursive;text-shadow:none;">
        * 檢視每年預算達成率 *</font></h1>  
    <?php  
		include("../connMysql.php");
		if (!@mysql_select_db("testabc_main")) die("資料庫選擇失敗!");
	    mysql_query("set names 'utf8'");
		$cid=$_SESSION['cid'];
		$year=$_SESSION['year'];	
		$month=$_SESSION['month']-1;
		$round=$month+($year-1)*12;
		error_reporting(0);
		
		
		
		for($i=1;$i<=5;$i++){
			//預算---------------------------------------------------------------------
			$temp = mysql_query("SELECT * FROM `budget` WHERE `cid`='$cid' AND `year`='$i'");
			$result = mysql_fetch_array($temp);
			
			$b_sell_A[$i] = $result['sell_A']*20000;
			$b_sell_B[$i] = $result['sell_B']*15000;
			$c_sell_A[$i] = $result['sell_A']*4100;
			$c_sell_B[$i] = $result['sell_B']*3100;
	
			$b_human_A[$i] = $result['hire_equip']*32000;
			$b_human_B[$i] = $result['hire_human']*32000;
			$b_human_C[$i] = $result['hire_research']*30000;
			$b_human_D[$i] = $result['hire_sale']*29000;
			$b_human_E[$i] = $result['hire_finance']*25000;
			$b_salary[$i] =  $b_human_A[$i]+$b_human_B[$i]+$b_human_C[$i]+$b_human_D[$i]+$b_human_E[$i];
			
			$b_internet_A[$i] = $result['internet_A']*4000;
			$b_internet_B[$i] = $result['internet_B']*4000;
			$b_TV_A[$i] = $result['TV_A']*8000;
			$b_TV_B[$i] = $result['TV_B']*6000;
			$b_magazine_A[$i] = $result['magazine_A']*20000;
			$b_magazine_B[$i] = $result['magazine_B']*20000;
			$b_func1_A[$i] = $result['func1_A']*200000;
			$b_func2_A[$i] = $result['func2_A']*200000;
			$b_func3_A[$i] = $result['func3_A']*200000;
			$b_func1_B[$i] = $result['func1_B']*200000;
			$b_func2_B[$i] = $result['func2_B']*200000;
			$b_func3_B[$i] = $result['func3_B']*200000;
			$b_market[$i]  = $b_internet_A[$i]+$b_internet_B[$i]+$b_TV_A[$i]+$b_TV_B[$i]+$b_magazine_A[$i]+$b_magazine_B[$i]+$b_func1_A[$i]+$b_func2_A[$i]+$b_func3_A[$i]+$b_func1_B[$i]+$b_func2_B[$i]+$b_func3_B[$i];
			
			$b_research_A[$i] =$result['rd_A']*1500000;
			$b_research_B[$i] =$result['rd_B']*1500000;
			$b_research[$i] = $b_research_A[$i]+$b_research_B[$i];
			//實際--------------------------------------------------------------------------------------------------`month`<=($year-1)*12 AND `month` > ($year-2)*12
			//銷貨收入
			$temp = mysql_query("SELECT SUM(`price`) FROM `operating_revenue` WHERE `cid`='$cid' AND `name`='41' AND `month`<=($i)*12 AND `month` > ($i-1)*12");
			$result = mysql_fetch_array($temp);
			$sell_A[$i] = $result[0];
			if($sell_A[$i] == ""){
				$sell_A[$i] = 0;
			}
			$temp = mysql_query("SELECT SUM(`price`) FROM `operating_revenue` WHERE `cid`='$cid' AND `name`='42' AND `month`<=($i)*12 AND `month` > ($i-1)*12");
			$result = mysql_fetch_array($temp);
			$sell_B[$i] = $result[0];
			if($sell_B[$i] == ""){
				$sell_B[$i] = 0;
			}
		
			//銷貨成本
			$temp = mysql_query("SELECT SUM(`price`) FROM `operating_costs` WHERE `cid`='$cid' AND `name`='5111' AND `month`<=($i)*12 AND `month` > ($i-1)*12");
			$result = mysql_fetch_array($temp);
			$cost_A[$i] = $result[0];
			if($cost_A[$i] == ""){
				$cost_A[$i] = 0;
			}
			$temp = mysql_query("SELECT SUM(`price`) FROM `operating_costs` WHERE `cid`='$cid' AND `name`='5112' AND `month`<=($i)*12 AND `month` > ($i-1)*12");
			$result = mysql_fetch_array($temp);
			$cost_B[$i] = $result[0];
			if($cost_B[$i] == ""){
				$cost_B[$i] = 0;
			}
			//薪資
			$temp = mysql_query("SELECT SUM(`price`) FROM `operating_expenses` WHERE `cid`='$cid' AND `name`='512' AND `month`<=($i)*12 AND `month`>($i-1)*12");
			$result = mysql_fetch_array($temp);
			$salary[$i] = $result[0];
			if($salary[$i] == ""){
				$salary[$i] = 0;
			}
			//推銷費用
			$temp = mysql_query("SELECT SUM(`price`) FROM `operating_expenses` WHERE `cid`='$cid' AND `name`='515' AND `month`<=($i)*12 AND `month` > ($i-1)*12");
			$result = mysql_fetch_array($temp);
			$market[$i] = $result[0];
			if($market[$i] == ""){
				$market[$i] = 0;
			}
			//研究費用
			$temp = mysql_query("SELECT SUM(`price`) FROM `operating_expenses` WHERE `cid`='$cid' AND `name`='524' AND `month`<=($i)*12 AND `month` > ($i-1)*12");
			$result = mysql_fetch_array($temp);
			$research[$i] = $result[0];
			if($research[$i] == ""){
				$research[$i] = 0;
			}
			$revenue[$i]=$sell_A[$i]+$sell_B[$i];
			$cost[$i]=$cost_A[$i]+$cost_B[$i];
			$gross[$i]=$revenue[$i]-$cost[$i];
			$expense[$i]=-($salary[$i]+$market[$i]+$research[$i]);
			$open[$i]=$gross[$i]-$expense[$i];
			$tax[$i]=0.17*($gross[$i]-$expense[$i]);
			$net[$i]=0.83*($gross[$i]-$expense[$i]);
			//達成率------------------------------------------------------------------------------------------------
			//銷貨收入
			if($b_sell_A[$i] != 0){
				$sell_A_rate[$i] = ($sell_A[$i] / $b_sell_A[$i])*100;
			}
			else{
				$sell_A_rate[$i] = 0;
			}
			
			if($b_sell_B[$i] != 0){
				$sell_B_rate[$i] = ($sell_B[$i] / $b_sell_B[$i])*100;
			}
			else{
				$sell_B_rate[$i] = 0;
			}
			//銷貨成本
			if($c_sell_A[$i] != 0){
				$cost_A_rate[$i] = ($cost_A[$i] / $c_sell_A[$i])*100;
			}
			else{
				$cost_A_rate[$i] = 0;
			}
			if($c_sell_B[$i] != 0){
				$cost_B_rate[$i] = ($cost_B[$i] / $c_sell_B[$i])*100;
			}
			else{
				$cost_B_rate[$i] = 0;
			}
			//薪資
			if($b_salary[$i] != 0){
				$salary_rate[$i] = (-$salary[$i] / $b_salary[$i])*100;
			}
			else{
				$salary_rate[$i] = 0;
			}
			//研究開發
			if($b_research[$i] != 0){
				$research_rate[$i] = (-$research[$i] /$b_research[$i])*100;
			}
			else{
				$research_rate[$i] = 0;
			}
			//推銷
			if($b_market[$i] != 0){
				$market_rate[$i] = (-$market[$i] /$b_market[$i])*100;
			}
			else{
				$market_rate[$i] = 0;
			}
			//營業毛利%
			$total_revenue_rate[$i]= $sell_A_rate[$i]+$sell_B_rate[$i]-$cost_A_rate[$i]-$cost_B_rate[$i];
			//營業費用合計%
			$total_market_rate[$i] = $salary_rate[$i]+$research_rate[$i]+$market_rate[$i];
			//營業淨利
			$total_net_rate[$i]	=	$total_revenue_rate[$i]+$total_market_rate[$i];
			//所得稅
			
			//------------------------------------------------
			}
	
	
		//當年--------------------------------------------------------------------------------------------------
		$temp = mysql_query("SELECT * FROM `budget` WHERE `cid`='$cid' AND `year`='$year'");
		$result = mysql_fetch_array($temp);
		
		//營業收入
		$current_income = $result['sell_A']*20000+$result['sell_B']*15000;
		//營業成本
		$current_cost = $result['sell_A']*4100+$result['sell_B']*3100;
		//薪資
		$current_salary	= -150000 - $result['hire_equip']*32000 - $result['hire_human']*32000 - $result['hire_research']*30000 - $result['hire_sale']*29000 - $result['hire_finance']*25000;
		//推銷
		$current_market =0-(($result['internet_A']*4000+$result['TV_A']*8000+$result['magazine_A']*20000+$result['func1_A']*200000+$result['func2_A']*200000+$result['func3_A']*200000)+
		($result['internet_B']*4000+$result['TV_B']*6000+$result['magazine_B']*20000+$result['func1_B']*200000+$result['func2_B']*200000+$result['func3_B']*200000));
		//研究
		$current_research = 0-($result['rd_A']*1500000+$result['rd_B']*1500000);
		//營業費用合計
		$current_expense = $current_salary+$current_market+$current_research;
		//淨利
		$current_net =$current_income-$current_cost+$current_expense;
		
	?>

  
   	<div id="myCarousel" class="carousel slide" >			<!-- 這3行引進左右滑動畫面 -->
	    <!-- Indicators -->
	    <ol class="carousel-indicators">
	      <li data-target="#myCarousel" data-slide-to="0" ></li>
	      <li data-target="#myCarousel" data-slide-to="1"></li>
	      <li data-target="#myCarousel" data-slide-to="2"></li>
	      <li data-target="#myCarousel" data-slide-to="3"></li>
	    </ol>
	
	    <!-- Wrapper for slides -->
	    <div class="carousel-inner" role="listbox">
	      <div class="item active">			<!-- 第一張表 -->
		      <table class="table table-bordered table-striped" >
		        <tr class="active">
				    <td  class="success" >預算--損益表</td>
				    <td>當年</td>
				    <td>第一年</td>
				    <td>達成率</td>
				    <td>第二年</td>
				    <td>達成率</td>
				  </tr>
		        
					  <tr class="active">
					    <td scope="row">營業收入</td>
					    <td><?php echo number_format($result['sell_A']*20000+$result['sell_B']*15000); ?></td>
					    <td><?php echo number_format($sell_A[1]+$sell_B[1]); ?></td>
					    <td><?php echo number_format($sell_A_rate[1]+$sell_B_rate[1],2); ?>%</td>
					    <td><?php echo number_format($sell_A[2]+$sell_B[2]); ?></td>
					    <td><?php echo number_format($sell_A_rate[2]+$sell_B_rate[2],2); ?>%</td>
					  </tr>
					  <tr class="active">
					    <td class="ytable" scope="row">銷貨收入-A產品</td>
					    <td><?php echo number_format($result['sell_A']*20000); ?></td>
					    <td><?php echo number_format($sell_A[1]); ?></td>
					    <td><?php echo number_format($sell_A_rate[1],2); ?>%</td>
					    <td><?php echo number_format($sell_A[2]); ?></td>
					    <td><?php echo number_format($sell_A_rate[2],2); ?>%</td>
					  </tr>
					  <tr class="active">
					    <td class="ytable" scope="row">銷貨收入-B產品</td>
					    <td><?php echo number_format($result['sell_B']*15000); ?></td>
					    <td><?php echo number_format($sell_B[1]); ?></td>
					    <td><?php echo number_format($sell_B_rate[1],2); ?>%</td>
					    <td><?php echo number_format($sell_B[2]); ?></td>
					    <td><?php echo number_format($sell_B_rate[2],2); ?>%</td>
					  </tr>
					  <tr class="active">
					    <td scope="row">營業成本</td>
					    <td><?php echo number_format($result['sell_A']*4100+ $result['sell_B']*3100); ?></td>
					    <td><?php echo number_format($cost_A[1]+$cost_B[1]); ?></td>
					    <td><?php echo number_format($cost_A_rate[1]+$cost_B_rate[1],2); ?>%</td>
					    <td><?php echo number_format($cost_A[2]+$cost_B[2]); ?></td>
					    <td><?php echo number_format($cost_A_rate[2]+$cost_B_rate[2],2); ?>%</td>
					  </tr>
					  <tr class="active">
					    <td scope="row">銷貨成本-A產品</td>
					    <td><?php echo number_format($result['sell_A']*4100); ?></td>
					    <td><?php echo number_format($cost_A[1]); ?></td>
					    <td><?php echo number_format($cost_A_rate[1],2); ?>%</td>
					    <td><?php echo number_format($cost_A[2]); ?></td>
					    <td><?php echo number_format($cost_A_rate[2],2); ?>%</td>
					  </tr>
					  <tr class="active">
					    <td scope="row">銷貨成本-B產品</td>
					    <td><?php echo number_format($result['sell_B']*3100); ?></td>
					    <td><?php echo number_format($cost_B[1]); ?></td>
					    <td><?php echo number_format($cost_B_rate[1],2); ?>%</td>
					    <td><?php echo number_format($cost_B[2]); ?></td>
					    <td><?php echo number_format($cost_B_rate[2],2); ?>%</td>
					  </tr>
					  <tr class="active">
					    <td scope="row">營業毛利</td>
					    <td><?php echo number_format($current_income-$current_cost); ?></td>
					    <td><?php echo number_format($sell_A[1]+$sell_B[1]-$cost_A[1]-$cost_B[1]); ?></td>
					    <td><?php echo number_format($total_revenue_rate[1],2); ?>%</td>
					    <td><?php echo number_format($sell_A[2]+$sell_B[2]-$cost_A[2]-$cost_B[2]); ?></td>
					    <td><?php echo number_format($total_revenue_rate[2],2); ?>%</td>
					  </tr>
				  </table>
				  <br><br>
		     </div>
	
	      <div class="item">				<!-- 第二張表 -->
		      <table class="table table-bordered table-striped" >
		       <tr class="active">
				    <td  class="success" >預算--損益表</td>
				    <td>第三年</td>
				    <td>達成率</td>
				    <td>第四年</td>
				    <td>達成率</td>
				    <td>第五年</td>
				    <td>達成率</td>
				</tr>
				
				 <tr class="active">
					    <td scope="row">營業收入</td>
					    <td><?php echo number_format($sell_A[3]+$sell_B[3]); ?></td>
					    <td><?php echo number_format($sell_A_rate[3]+$sell_B_rate[3],2); ?>%</td>
					    <td><?php echo number_format($sell_A[4]+$sell_B[4]); ?></td>
					    <td><?php echo number_format($sell_A_rate[4]+$sell_B_rate[4],2); ?>%</td>
					    <td><?php echo number_format($sell_A[5]+$sell_B[5]); ?></td>
					    <td><?php echo number_format($sell_A_rate[5]+$sell_B_rate[5],2); ?>%</td>
					  </tr>
					  <tr class="active">
					    <td class="ytable" scope="row">銷貨收入-A產品</td>
					    <td><?php echo number_format($sell_A[3]); ?></td>
					    <td><?php echo number_format($sell_A_rate[3],2); ?>%</td>
					    <td><?php echo number_format($sell_A[4]); ?></td>
					    <td><?php echo number_format($sell_A_rate[4],2); ?>%</td>
					    <td><?php echo number_format($sell_A[5]); ?></td>
					    <td><?php echo number_format($sell_A_rate[5],2); ?>%</td>
					  </tr>
					  <tr class="active">
					    <td class="ytable" scope="row">銷貨收入-B產品</td>
					    <td><?php echo number_format($sell_B[3]); ?></td>
					    <td><?php echo number_format($sell_B_rate[3],2); ?>%</td>
					    <td><?php echo number_format($sell_B[4]); ?></td>
					    <td><?php echo number_format($sell_B_rate[4],2); ?>%</td>
					    <td><?php echo number_format($sell_B[5]); ?></td>
					    <td><?php echo number_format($sell_B_rate[5],2); ?>%</td>
					  </tr>
					  <tr class="active">
					    <td scope="row">營業成本</td>
					    <td><?php echo number_format($cost_A[3]+$cost_B[3]); ?></td>
					    <td><?php echo number_format($cost_A_rate[3]+$cost_B_rate[3],2); ?>%</td>
					    <td><?php echo number_format($cost_A[4]+$cost_B[4]); ?></td>
					    <td><?php echo number_format($cost_A_rate[4]+$cost_B_rate[4],2); ?>%</td>
					    <td><?php echo number_format($cost_A[5]+$cost_B[5]); ?></td>
					    <td><?php echo number_format($cost_A_rate[5]+$cost_B_rate[5],2); ?>%</td>
					  </tr>
					  <tr class="active">
					    <td scope="row">銷貨成本-A產品</td>
					    <td><?php echo number_format($cost_A[3]); ?></td>
					    <td><?php echo number_format($cost_A_rate[3],2); ?>%</td>
					    <td><?php echo number_format($cost_A[4]); ?></td>
					    <td><?php echo number_format($cost_A_rate[4],2); ?>%</td>
					    <td><?php echo number_format($cost_A[5]); ?></td>
					    <td><?php echo number_format($cost_A_rate[5],2); ?>%</td>
					  </tr>
					  <tr class="active">
					    <td scope="row">銷貨成本-B產品</td>
					    <td><?php echo number_format($cost_B[3]); ?></td>
					    <td><?php echo number_format($cost_B_rate[3],2); ?>%</td>
					    <td><?php echo number_format($cost_B[4]); ?></td>
					    <td><?php echo number_format($cost_B_rate[4],2); ?>%</td>
					    <td><?php echo number_format($cost_B[5]); ?></td>
					    <td><?php echo number_format($cost_B_rate[5],2); ?>%</td>
					  </tr>
					  <tr class="active">
					    <td scope="row">營業毛利</td>
					    <td><?php echo number_format($sell_A[3]+$sell_B[3]-$cost_A[3]-$cost_B[3]); ?></td>
					    <td><?php echo number_format($total_revenue_rate[3],2); ?>%</td>
					    <td><?php echo number_format($sell_A[4]+$sell_B[4]-$cost_A[4]-$cost_B[4]); ?></td>
					    <td><?php echo number_format($total_revenue_rate[4],2); ?>%</td>
					    <td><?php echo number_format($sell_A[5]+$sell_B[5]-$cost_A[5]-$cost_B[5]); ?></td>
					    <td><?php echo number_format($total_revenue_rate[5],2); ?>%</td>
					  </tr>
				  
			</table><br><br>
	      </div>
	      
	      <div class="item">				<!-- 第三張表 -->
		      <table class="table table-bordered table-striped" >
		      <tr class="active">
				    <td  class="success" >營業費用</td>
				    <td>當年</td>
				    <td>第一年</td>
				    <td>達成率</td>
				    <td>第二年</td>
				    <td>達成率</td>
				  </tr>
				  
				  <tr class="active">
				    <td scope="row">薪資費用</td>
				    <td><?php echo number_format($current_salary); ?></td>
				    <td><?php echo number_format($salary[1]); ?></td>
				    <td><?php echo number_format($salary_rate[1],2); ?>%</td>
				    <td><?php echo number_format($salary[2]); ?></td>
				    <td><?php echo number_format($salary_rate[2],2) ?>%</td>
				  </tr>
				  <tr class="active">
				    <td scope="row">推銷費用</td>
				    <td><?php echo number_format($current_market); ?></td>
				    <td><?php echo $market[1]; ?></td>
				    <td><?php echo number_format($market_rate[1],2); ?>%</td>
				    <td><?php echo number_format($market[2]); ?></td>
				    <td><?php echo number_format($market_rate[2],2); ?>%</td>
				  </tr>
				  <tr class="active">
				    <td scope="row">研究發展費用</td>
				    <td><?php echo number_format($current_research); ?></td>
				    <td><?php echo number_format($research[1]); ?></td>
				    <td><?php echo number_format($research_rate[1],2) ?>%</td>
				    <td><?php echo number_format($research[2]); ?></td>
				    <td><?php echo number_format($research_rate[2],2) ?>%</td>
				  </tr>
				  <tr class="active">
				    <td scope="row">營業費用合計</td>
				    <td><?php echo number_format($current_expense); ?></td>
				    <td><?php echo number_format($expense[1]); ?></td>
				    <td><?php echo number_format($total_market_rate[1],2); ?>%</td>
				    <td><?php echo number_format($expense[2]); ?></td>
				    <td><?php echo number_format($total_market_rate[2],2); ?>%</td>
				  </tr>
				  <tr class="active">
				    <td scope="row">營業淨利</td>
				    <td><?php echo number_format($current_net);?></td>
				    <td><?php echo number_format($open[1]); ?></td>
				    <td><?php echo number_format($total_net_rate[1],2); ?>%</td>
				    <td><?php echo number_format($open[2]); ?></td>
				    <td><?php echo number_format($total_net_rate[2],2); ?>%</td>
				  </tr>
				  <tr class="active">
				    <td scope="row">所得稅費用</td>
				    <td><?php echo number_format($current_net*0.17);?></td>
				    <td><?php echo number_format($tax[1]); ?></td>
				    <td><?php echo number_format((0.17*$total_net_rate[1]),2)?>%</td>
				    <td><?php echo number_format($tax[2]); ?></td>
				    <td><?php echo number_format((0.17*$total_net_rate[2]),2)?>%</td>
				  </tr>
				  <tr class="active">
				    <td scope="row"><strong>淨利</strong></td>
				    <td><?php echo number_format($current_net*0.83);?></td>
				    <td><?php echo number_format($net[1]); ?></td>
				    <td><?php echo number_format((0.83*$total_net_rate[1]),2)?>%</td>
				    <td><?php echo number_format($net[2]); ?></td>
				    <td><?php echo number_format((0.83*$total_net_rate[2]),2)?>%</td>
				  </tr>
		      </table><br><br>
	      </div>
	      
	      <div class="item">				<!-- 第四張表 -->
		      <table class="table table-bordered table-striped" >
		      <tr class="active">
				    <td  class="success" >營業費用</td>
				    <td>第三年</td>
				    <td>達成率</td>
				    <td>第四年</td>
				    <td>達成率</td>
				    <td>第五年</td>
				    <td>達成率</td>
				</tr>
				<tr class="active">
				    <td scope="row">薪資費用</td>
				    <td><?php echo number_format($salary[3]); ?></td>
				    <td><?php echo number_format($salary_rate[3],2) ?>%</td>
				    <td><?php echo number_format($salary[4]); ?></td>
				    <td><?php echo number_format($salary_rate[4],2) ?>%</td>
				    <td><?php echo number_format($salary[5]); ?></td>
				    <td><?php echo number_format($salary_rate[5],2) ?>%</td>
				  </tr>
				  <tr class="active">
				    <td scope="row">推銷費用</td>
				    <td><?php echo number_format($market[3]); ?></td>
				    <td><?php echo number_format($market_rate[3],2); ?>%</td>
				    <td><?php echo number_format($market[4]); ?></td>
				    <td><?php echo number_format($market_rate[4],2); ?>%</td>
				    <td><?php echo number_format($market[5]); ?></td>
				    <td><?php echo number_format($market_rate[5],2); ?>%</td>
				  </tr>
				  <tr class="active">
				    <td scope="row">研究發展費用</td>
				    <td><?php echo number_format($research[3]); ?></td>
				    <td><?php echo number_format($research_rate[3],2) ?>%</td>
				    <td><?php echo number_format($research[4]); ?></td>
				    <td><?php echo number_format($research_rate[4],2) ?>%</td>
				    <td><?php echo number_format($research[5]); ?></td>
				    <td><?php echo number_format($research_rate[5],2) ?>%</td>
				  </tr>
				  <tr class="active">
				    <td scope="row">營業費用合計</td>
				    <td><?php echo number_format($expense[3]); ?></td>
				    <td><?php echo number_format($total_market_rate[3],2); ?>%</td>
				    <td><?php echo number_format($expense[4]); ?></td>
				    <td><?php echo number_format($total_market_rate[4],2); ?>%</td>
				    <td><?php echo number_format($expense[5]); ?></td>
				    <td><?php echo number_format($total_market_rate[5],2); ?>%</td>
				  </tr>
				  <tr class="active">
				    <td scope="row">營業淨利</td>
				    <td><?php echo number_format($open[3]); ?></td>
				    <td><?php echo number_format($total_net_rate[3],2); ?>%</td>
				    <td><?php echo number_format($open[4]); ?></td>
				    <td><?php echo number_format($total_net_rate[4],2); ?>%</td>
				    <td><?php echo number_format($open[5]); ?></td>
				    <td><?php echo number_format($total_net_rate[5],2); ?>%</td>
				  </tr>
				  <tr class="active">
				    <td scope="row">所得稅費用</td>
				    <td><?php echo number_format($tax[3]); ?></td>
				    <td><?php echo number_format((0.17*$total_net_rate[3]),2)?>%</td>
				    <td><?php echo number_format($tax[4]); ?></td>
				    <td><?php echo number_format((0.17*$total_net_rate[4]),2)?>%</td>
				    <td><?php echo number_format($tax[5]); ?></td>
				    <td><?php echo number_format((0.17*$total_net_rate[5]),2)?>%</td>
				  </tr>
				  <tr class="active">
				    <td scope="row"><strong>淨利</strong></td>
				    <td><?php echo number_format($net[3]); ?></td>
				    <td><?php echo number_format((0.83*$total_net_rate[3]),2)?>%</td>
				    <td><?php echo number_format($net[4]); ?></td>
				    <td><?php echo number_format((0.83*$total_net_rate[4]),2)?>%</td>
				    <td><?php echo number_format($net[5]); ?></td>
				    <td><?php echo number_format((0.83*$total_net_rate[5]),2)?>%</td>
				  </tr>
		      </table><br><br>
	      </div>
	    
	    </div>
	
	    <!-- Left and right controls -->
	    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
	      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
	      <span class="sr-only">Previous</span>
	    </a>
	    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
	      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	      <span class="sr-only">Next</span>
	    </a>
	  </div>
	</div>

            
    </div><!-- end content -->
</body>
</html>