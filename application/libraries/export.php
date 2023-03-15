<?php if (!defined('BASEPATH')) exit('No direct script access allowed');  

class Export{

function to_excel($array, $filename) {
    
	header('Content-Disposition: attachment; filename='.$filename.'.xls');
    header('Content-type: application/force-download');
    header('Content-Transfer-Encoding: binary');
    header('Pragma: public');
    print "\xEF\xBB\xBF"; // UTF-8 BOM ?>
 	
     <style>
    .tftable {font-size:12px;color:#333333;width:100%; padding:6px;border-width: 1px;border-color: #729ea5;border-collapse: collapse;}
	.tftable th {font-size:16px;background-color:#acc8cc;border-width: 1px;padding: 10px;border-style: solid;border-color: #729ea5;text-align:center;}
	.tftable td {font-size:12px;border-width: 1px; text-align:left;padding: 8px;border-style: solid;border-color: #729ea5;}
     h4 { background-color:#00CCFF; padding:8px; }</style>
    
    <table class="tftable" border="1" align="center" width="90%">
    <tr><th colspan="2" align="center"><b>View Order Details</b></th></tr>
    <tr><td colspan="2"><b><h4>Product Details:</h4></b></td></tr>
    <tr><td>Product Title   </td>            <td><?php echo $array['product_title']; ?></td></tr>
    <tr><td>Unit Price	    </td>            <td><?php echo "$".$array['unit_price']; ?></td></tr>
    <tr><td>Qunatity	    </td>            <td><?php echo $array['quantity']; ?></td></tr>
    <tr><td>Total			</td>            <td><?php echo "$".$array['total']; ?></td></tr>
    <tr><td>Purchasing Date	</td>            <td><?php echo $array['purchasing_date']; ?></td></tr>
    <tr><td>Purchased By	</td>            <td><?php echo $array['u_first_name']; ?></td></tr>
    <tr><td>Ship Amount		</td>            <td><?php echo "$".$array['ship_amount']; ?></td></tr>
    <tr><td>Tax Applied		</td>            <td><?php echo "$".$array['tax_amount']; ?></td></tr>
    <tr><td>Final Amount	</td>            <td><?php echo "$".$array['product_amount']; ?></td></tr>
    
    <tr>&nbsp;</tr>
    <tr><td colspan="2"><b><h4>Billing Details:</h4></b></td></tr>
    
    <tr><td>Person Name		</td>			<td><?php echo $array['b_first_name']." ".$array['b_last_name']; ?></td></tr>
    <tr><td>Company			</td>			<td><?php echo $array['b_company']; ?></td></tr>
    <tr><td>Phone Number	</td>			<td><?php echo $array['b_phone']; ?></td></tr>
    <tr><td>City			</td>			<td><?php echo $array['b_city']; ?></td></tr>
    <tr><td>State			</td>			<td><?php echo $array['b_state']; ?></td></tr>
    <tr><td>Country			</td>			<td><?php echo $array['b_country_id']; ?></td></tr>
    <tr><td>Address 1		</td>			<td><?php echo $array['b_address_1']; ?></td></tr>
    <tr><td>Address 2		</td>			<td><?php echo $array['b_address_2']; ?></td></tr>
    <tr><td>Zip				</td>			<td><?php echo $array['b_zip']; ?></td></tr>
    <tr>&nbsp;</tr>
    
    <tr><td colspan="2"><b><h4>Shipping Details:</h4></b></td></tr>
    
    <tr><td>Person Name		</td>		<td><?php echo $array['s_first_name']." ".$array['s_last_name']; ?></td></tr>
    <tr><td>Company			</td>		<td><?php echo $array['s_company']; ?></td></tr>
    <tr><td>Phone Number	</td>		<td><?php echo $array['s_phone']; ?></td></tr>
    <tr><td>City			</td>		<td><?php echo $array['s_city']; ?></td></tr>
    <tr><td>State			</td>		<td><?php echo $array['s_state']; ?></td></tr>
    <tr><td>Country			</td>		<td><?php echo $array['s_country_id']; ?></td></tr>
    <tr><td>Address 1		</td>		<td><?php echo $array['s_address_1']; ?></td></tr>
    <tr><td>Address 2		</td>		<td><?php echo $array['s_address_2']; ?></td></tr>
    <tr><td>Zip				</td>		<td><?php echo $array['s_zip']; ?></td></tr>
    <tr>&nbsp;</tr>
    </table>
   
 <?php 
    }
}
?>
