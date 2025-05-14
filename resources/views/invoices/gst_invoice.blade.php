<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80vw;
            max-width: 800px;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .god_name {
            display: flex;
            justify-content: space-between;
            text-align: center;
            margin-bottom: 10px;
        }

        .gstno {
            display: flex;
            justify-content: space-between;
        }

        .main_page {
            border: 1px solid black;
        }

        .headings {
            padding: 5px;
            display: flex;
            justify-content: space-between;
            font-weight: bolder;
            font-size: 15px;
        }

        .debit_memo,
        .tax_invoice,
        .duplicate {
            width: 33.33%;
            border: 1px solid black;
            padding: 0 5px;
            text-align: center;
        }

        .com_name {
            display: flex;
            justify-content: space-between;
            padding: 5px;
        }

        .detail {
            width: 70%;
            border: 1px solid black;
            padding: 5px;
            display: inline-flex;
        }

        .invoice_no {
            width: 29%;
            border: 1px solid black;
            padding: 5px;
        }

        .table_data {
            padding: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        tr {
            border: 1px solid black;
        }

        th,
        td {
            border: 1px solid black;
            padding: 5px;
        }

        .total_sub {
            padding: 5px;
            display: flex;
            flex-direction: column;
        }

        .two_entry {
            display: flex;
        }

        .blank_area {
            width: 50%;
            height: 136px;
            border: 1px solid black;
        }

        .sub_total {
            width: 30%;
        }

        .prices {
            width: 20%;
        }

        .sub_total,
        .prices {
            border: 1px solid black;
            text-align: end;
        }

        .prices {
            text-align: right;
        }

        .sub_total_title {
            font-weight: bold;
            border: 1px solid black;
        }

        .IGST {
            height: 100px;
        }

        .rs_in_words {
            border: 1px solid black;
            padding: 5px;
        }

        .bank_details,.terms {
            width: 100%;
            border: 1px solid black;
            display: flex;
            justify-content: space-between;
        }

        .bank_part,.terms_conditions_part {
            padding: 5px;
        }
        .bank_titles,.ifs_code, .bank_name {
            display: flex;
            justify-content: space-between;
        }
        .posted{
            border: 10px solid green;
            border-radius: 5px;
            width: 90%;
            color: green;
            text-align: center;
            font-weight: bold;
            font-size: 45px;
        }




        .totals {
       
      
        margin-top: 8px;
    }
    .totals td {
        text-align: right;
        
    } 
        .terms_conditions_part {
  margin-top: 0.25rem; /* mt-1 */
  display: grid; /* grid */
  grid-template-columns: 20% 80%; /* grid-cols-[20%,80%] */
  border: 1px solid #000; /* border border-black */
  padding: 0.5rem; /* px-2 */
}

.terms {
  display: flex; /* flex */
  flex-direction: column; /* flex-col */
  justify-content: space-between; /* justify-between */
}

.terms_conditions {
  text-align: left; /* text-left */
  margin-left:3px;
  
}

.terms_conditions p strong {
  font-weight: 600; /* font-semibold */
  margin-left: 3px;
}

.terms_conditions p {
  line-height: 1.25; /* leading-tight */
}

.authorized_signature {
  text-align: right; /* text-right */
}

.bank_part {
  /* add styles for the bank_part container */
}

.bank_details {
  /* add styles for the bank_details container */
  display: flex;
  flex-direction: column;
  align-items: center;
}

.bank_titles {
  /* add styles for the bank_titles container */
  margin-bottom: 10px;
}

.bank_titles strong {
  /* add styles for the strong element */
  font-weight: 600;
  font-size: 18px;
}

.bank_name {
  /* add styles for the bank_name container */
  display: flex;
  justify-content: space-between;
  margin-bottom: 10px;
}

.bank_name div {
  /* add styles for the div elements inside bank_name */
  width: 50%;
}

.bank_name p {
  /* add styles for the p elements inside bank_name */
  margin-bottom: 5px;
}

.ifs_code {
  /* add styles for the ifs_code container */
  display: flex;
  justify-content: space-between;
}

.ifs_code div {
  /* add styles for the div elements inside ifs_code */
  width: 50%;
}

.ifs_code p {
  /* add styles for the p elements inside ifs_code */
  margin-bottom: 5px;
}




.total_sub {
  /* add styles for the total_sub container */
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.two_entry {
  /* add styles for the two_entry container */
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
}

.blank_area {
  /* add styles for the blank_area container */
  width: 20%;
}

.sub_total {
  /* add styles for the sub_total container */
  width: 40%;
  text-align: right;
}

.sub_total_title {
  /* add styles for the sub_total_title elements */
  font-weight: 600;
  font-size: 16px;
  margin-bottom: 10px;
}

.IGST {
  /* add styles for the IGST elements */
  font-size: 14px;
  color: #666;
  margin-bottom: 10px;
}

.prices {
  /* add styles for the prices container */
  width: 40%;
  text-align: right;
}

.prices div {
  /* add styles for the div elements inside prices */
  margin-bottom: 10px;
}

.rs_in_words {
  /* add styles for the rs_in_words container */
  font-size: 14px;
  color: #666;
  margin-top: 20px;
}

.rs_in_words strong {
  /* add styles for the strong element */
  font-weight: 600;
}


.table_data {
  width: 100%;
  overflow-x: auto;
}

.table_data table {
  border-collapse: collapse;
  width: 100%;
}

.table_data th,.table_data td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

.table_data th {
  background-color: #f0f0f0;
  font-weight: 600;
}

.table_data td {
  text-align: center;
}

.table_data td:nth-child(1) {
  width: 5%;
}

.table_data td:nth-child(2) {
  width: 40%;
}

.table_data td:nth-child(3) {
  width: 15%;
}

.table_data td:nth-child(4) {
  width: 10%;
}

.table_data td:nth-child(5) {
  width: 5%;
}

.table_data td:nth-child(6) {
  width: 12.5%;
}

.table_data td:nth-child(7) {
  width: 12.5%;
}

.header-left {
        float: left;
        margin-left: 3px;
      }

 .header-right {
        float: right;
        margin-right: 3px;
      }
 .boxed {
      border: 1px solid #000;
      padding: 10px;
      text-align: center;
      margin-bottom: 10px;
        }
  .invoice-container {
            width: 210mm;
            margin: auto;
            padding: 20mm;
            border: 1px solid #000;
        }
.header div {
            display: inline-block;
            width: 32%;
            border: 1px solid #000;
            padding: 9px 0;
            font-weight: bold;
            
        }
        
</style>



<!-- <div class="flex min-h-screen items-center justify-center"> -->
      <!-- <div class="w-[800px] p-2"> -->
        <!-- <div class="flex justify-between"> -->
          <p class="header-left">|| Shri Ganeshay Namah ||</p>
          <p class="header-right">|| Jai Matadi ||</p>
        <!-- </div> -->
    <div class="boxed">
      <h1>Y.P. BICHIYA</h1>
      <p>MFG: ALL TYPE FANCY BICCHIYA & RAKHI<br>
      201 , K.D. CHAMBER, 2ND FLOOR, OPP PANJRAPOL, BHAVNAGAR ROAD, RAJKOT.<br>
      Mobile: 9510206016<br></p>
      <p>GSTIN: 24AFYPV7749C1ZO &nbsp; State: Gujarat State Code: 24 &nbsp; PAN No.:  AFYPV7749C</p>
    </div>
<!-- <p></p> -->
                <!-- <table>
                    <tr>
                    <td>Debit Memo</td>
                    <td>Tax Invoice</td>
                    <td>DUPLICATE</td>
                    </tr>
                    </table> -->
                    <!-- </div> -->
                    <!-- <div class="com_name">   
                    <div class="mt-1 grid grid-cols-[20%,80%] border border-black px-2"> -->
                <table>
                  <!-- <tr> -->
                    <td>
                      <strong>M/s. </strong><strong>{{ $client->name }}</strong><br>
                    {{ $client->address }}<br>
                        <!-- <p><strong></strong></p> -->
                        Phone No.: {{ $client->contact }}<br>
                        GSTIN No.: {{ $client->gst_in }}<br>
                        Place of Supply: {{ $client->city }}<br>
                        PAN No.: </td>
                    <td><p>Invoice No. :00{{ $invoice->id }}<br>
                        Invoice Date. :{{ $invoice->invoice_date }}</p>
                    </td>
                  <!-- </tr> -->
                 
                </table>
              </div>     
        </div>
                    </div>
                </div>
            

                <style>
    .table_data table {
        border-collapse: collapse;
        width: 100%;
    }
    .table_data th, .table_data td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }
    .table_data th {
        background-color: #f2f2f2;
    }

    .table_data table {
    border-collapse: separate; /* Use separate borders */
    border-spacing: 0 10px; /* Add spacing between rows */
}
.table_data td {
    padding: 10px; /* Add padding inside table cells */
}

</style>
<div class="totals">
    <table style="width:100%">
        <tr>
            <th>Sr. No.</th>
            <th>Particular</th>
            <th>HSNCode</th>
            <th>Quantity</th>
            <!-- <th>Unit</th>  -->
            <th>Rate</th>
            <th>Total</th>
            <th>Gst(%)</th>
            <th>Gst Amount</th>
            <th>Total Amount</th>
        </tr>
        @php
            $totalquantity = 0;
            $totalAmount = 0;
            $totalGstAmount = 0;
        @endphp
        
        @foreach($items as $item)
            @if($loop->last)
                <tr class="no-horizontal-border last-row">
            @else
                <tr class="no-horizontal-border">
            @endif
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->product->name }}</td>
                <td>7117</td>
                <td>{{ $item->quantity }}</td>
                <!-- <td></td> -->
                <td>{{ $item->price }}</td>
                <td>{{ $item->total }}</td>
                <td>{{ $item->gst_rate }}%</td>
                <td>{{ $item->gst_amount }}</td>
                <td>{{ $item->total + $item->gst_amount }}</td>
            </tr>
            @php
                $totalquantity += $item->quantity;
                $totalAmount += $item->total;
                $totalGstAmount += $item->gst_amount;
            @endphp
        @endforeach
    </table>
</div>

@php
    $grandTotal = $totalAmount + $totalGstAmount;
@endphp

<div class="totals">
    <table>
        <tr>
            <td><strong>Grand Total</strong></td>
            <td><strong>{{ $grandTotal }}</strong></td>
        </tr>
    </table>
</div>
                    <!-- <table>
                        <tr>
                            <td><strong>Grand Total</strong></td>
                            <td><strong>{{ $invoice->total_amount }}</strong></td>
                        </tr>
                  </table>
                
                  </div> -->





      
   <style>


      table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
      }

      tr.no-horizontal-border td {
        border-top: none;
        border-bottom: none;
      }

      tr.last-row td {
        padding-bottom: 120px; /* Add space only below the last row */
      }

      table {
        margin-bottom: 20px; /* Add some space below the table */
      }

        table, th, td {
          border: 1px solid black;
          border-collapse: collapse;
        }

        tr.no-horizontal-border td {
          border-top: none;
          border-bottom: 50px;
        }
        
        tr.space-below td {
          padding-bottom: 120px; /* Adjust the space below each row */
        }

        table {
          margin-bottom: 20px; /* Add some space below the table */
        }
</style>  

    
              


    <div class="mt-1 grid grid-cols-[20%,80%] border border-black px-2">
    <div class="totals">
                   
                <table>
                  <tr>
                  <p class="font-semibold">Our Bank Details</p>
                  <td>bank</td>
                    <td>: ICICI Bank</td>
                    <td>bank</td>
                    <td>: RANCHHODNAGAR, RAJK</td>
                  </tr>

                  <tr>
                    <td></td>
                    <td>A/C No.</td>
                    <td>: 239605500617</td>
                    <td>NEFT/IFS Code</td>
                    <td>: ICIC0002396</td>
                  </tr>
                </table>
              </div>
 <div class="totals">
                <div class="terms">
                    <div class="terms_conditions">
                    <div class="header-right">For Y.P. Bichiya</div>
                        <!-- <p> -->
                          <strong>Terms & Conditions</strong><br>
                
                        Subject to RAJKOT jurisdiction.<br>
                        Goods once sold will not be taken back.<br>
                        No Warranty, No Guarantee in any item.<br>
                        <div class="header-right">Authorized signatory</div>
                       interest will be charged at 18% p.a. on outstanding balance more than 30 days.
                      <!-- </p> -->
                    </div>
                </div>

        </div>
</body>

</html>