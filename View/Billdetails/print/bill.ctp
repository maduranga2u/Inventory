<style>
.bill{
    border: 1px solid #000;
    height: 842px;
    margin-left: auto;
    margin-right: auto;
    width: 595px;
}
.top{
margin-top:10px;
 margin-bottom: 25px;
}
.demo{
height:115px;
}
.set1{
padding:5px;
}
.left{
	border: 1px solid #000; 
    border-radius:5px;
}
.left_table1_row{
    border: 1px solid #000;
    height: 19px;
    padding: 0px 10px;
    width: auto;
   	}
.center_table{
	border: 1px solid #000;
    background:#000;
	color:white;
	height:auto;
    border-radius:5px;
	}
.center_table_row{
    height: 26px;
 	}
.right_table{
	border: 1px solid #000;
    border-radius:5px;
	}
.right_table_row{
    background: none repeat scroll 0 0 white;
    border: 1px solid #000;
    height: 26px;
    padding: 2px 13px;
    width: auto;		
	}
.b{
border: 1px solid #000;
height: 20px;}

.tb{
  border: 1px solid black;
  border-radius: 5px;
  height: 21px;
  background-color: #000;
  color: #fff;
  margin-bottom: 5px;
	}

.row_total{
padding:15px;

}

.total{
border: 1px solid #000;
border-radius:5px;
height:25px;
}
.t_text{
  margin-top: 5px;
}		
</style>
<section>
  <div class="container">
<div class="col-xs-offset-1">

<div class="bill">
<div class="col-xs-12 top">
<div class="col-xs-7">LOGO</div>
<div class="col-xs-5">
<div>CASH/CREDIT MEMO: </div>
<div>NO : <?php echo $billNo;?></div>
</div>
</div>


<div class="demo text-center">
	<h1><?php echo (Configure::read('Account.name'));?></h1>
    <p><?php echo (Configure::read('Account.address'));?></p>
</div>


<div class="col-xs-12 set1">

<div class=" col-xs-5">
<div class="left">
<div class="left_table1_row" >To:</div>
<div class="left_table1_row"><?php if(!empty($results)){echo $results[0]['Billdetail']['description'];}?> </div>
<div class="left_table1_row"> </div>
<div class="left_table1_row"> </div>
</div>
</div>

<div class="center_table col-xs-3">
<div class="center_table_row">Date :<?php if(!empty($results)){echo date('Y-m-d',strtotime($results[0]['Billdetail']['created']));}?></div>
<div class="center_table_row">Our Ref No:</div>
<div class="center_table_row">Your Ref No:</div>
</div>

<div class="col-xs-4">
<div class="right_table">
<div class="right_table_row"></div>
<div class="right_table_row"></div>
<div class="right_table_row"></div>
</div>
</div>

</div>

<div class="col-xs-12">
<div class="tb">
<div class="col-xs-2 text-center">Size</div>
<div class="col-xs-4 text-center">DESCRIPTION</div>
<div class="col-xs-2 text-center">QUT</div>
<div class="col-xs-2 text-center">RATE</div>
<div class="col-xs-2 text-center">Rs.</div>
</div>
</div>
<?php $sum=0;foreach($results as $si){?>
<div class="set2 col-xs-12">

<div class="col-xs-2 text-center b"><?php echo $si['Stockcode']['size'];?></div>
<div class="col-xs-4 text-center b"><?php echo $si['Stockcode']['name'];?></div>
<div class="col-xs-2 text-center b"><?php echo $si['stockentryitems']['amount'];?></div>
<div class="col-xs-2 text-center b"><?php echo $si['stockentryitems']['rate'];?></div>
<div class="col-xs-2 text-center b"><?php $sum+=$si['stockentryitems']['amount']*$si['stockentryitems']['rate'];echo $si['stockentryitems']['amount']*$si['stockentryitems']['rate'];?></div>

</div>
<?php } ?>
<div class="col-xs-12 row_total">
<div class="col-xs-6">Received Above Mentioned Items in good Conditions.</div>
<div class="col-xs-2 h4 t_text">TOTAL</div>
<div class="col-xs-4 total"><?php echo $sum;?></div>
</div>

<div >
<div class="col-xs-3 text-center">.............................<br />Customer Signature</div>
<div class="col-xs-3 text-center">.............................<br />Authorized by</div>
<div class="col-xs-3 text-center">.............................<br />Prepared by</div>
<div class="col-xs-3 text-center">.............................<br />Storekeeper Sig.</div>
</div>

  </div>
  </div>
  </div>
</section>