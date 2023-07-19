<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Reaign</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
</head>

<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    /*
    .container{
       width: 75vw !important; 
        flex-direction: row;
        justify-content: center;
    }
    */
    display: flex;

    .employee-reaign {
        margin-top: 2px;
    }

    .header {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .header img {
        width: 200px;
        height: auto;
    }

    .address {
        text-decoration: underline;
        font-size: 14px;
    }

    .title {
        text-align: center;
        font-size: 25px;
        background: #8a2061;
        color: #fff;
        padding: 8px;
        border-radius: 10px;
        margin-top: 5px;
    }

    .employee-details {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin-top: 2px;
    }

    .em-details {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .details {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-right: 20px;
    }

    .title-name {
        margin-right: 20px;
        font-size: 16px;
        font-weight: 700;
        color: #000;
    }

    .details input {
        border: none;
        font-size: 14px;
        padding: 2px;
        border-bottom: 2px solid #000;
        letter-spacing: 0.5px;
    }

    .table-section {
        margin-top: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .table {
        border-collapse: collapse;
        width: 80%;
        text-align: center;
    }

    .table td,
    .table th {
        border: 1px solid #ddd;
        padding: 5px;
        font-size: 14px;
    }

    .table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .table tr:hover {
        background-color: #ddd;
    }

    .table th {
        padding-top: 10px;
        padding-bottom: 10px;
        font-size: 16px;
        background-color: #8a2061;
        color: #fff;
    }

    .signature-section {
        margin: 10px;
        display: flex;
        justify-content: space-around;
        align-items: center;
    }

    .signature img {
        height: 40px;
        width: 100px;
    }

    .signature-by {
        border-top: 3px solid #000;
        padding: 5px;
        text-align: center;
        font-size: 18px;
        font-weight: 700;
        margin-top: 2px;
    }

    .signature-list{
        display: flex;
        justify-content: space-between;
    }

    .btn.btn-approve {
  background: green;
  color: #fff;
  padding: 10px 30px;
  text-decoration: none;
}
    .btn.btn-reject {
  background: #ca0d0d;
  padding: 10px 30px;
  margin-left: 20px;
  color: #fff !important;
  text-decoration: none;}

  .signature-section {
    margin: 10px;
    display: flex;
    justify-content: space-around;
    align-items: center;
    width: 1212px !IMPORTANT;
    margin: auto;
    padding-top: 20px;
}
</style>

<body>
    <a href="/admin/resign-master" class="btn btn-approve">Back</a>  
    <div class="container">
        <div class="employee-reaign">
            <div class="header">
                <img src="https://web.praavahealth.com/media/Global-header-footer/praava-health-logo.svg" alt="">
                <p class="address">Plot # 09, Road # 17, Block # C, Banani, Dhaka-1213</p>
                <h3 class="title">IT Check List for Employee Clearance</h3>
            </div>
            <div class="employee-details">
                <div class="em-details">
                    <div class="details">
                        <h3 class="title-name">Date</h3>
                        <input readonly value="{{ $resignMaster->cd }}">
                    </div>
                    <div class="details">
                       <h3 class="title-name">Employee Name</h3>
                       <input readonly value="{{ $employeeName }}">
                    </div>

                    <div class="details">
                        <h3 class="title-name">EID</h3>
                        <input readonly value="{{ $employeeId }}">
                    </div>
                </div>
                <div class="em-details">
                    <div class="details">
                        <h3 class="title-name">Contact No</h3>
                        <input readonly style="width: 280px;" value="{{ $employeeOffice .', ' . $employeePersonal }}">
                    </div>
                    <div class="details">
                        <h3 class="title-name">Designation</h3>
                        <input readonly style="width: 280px;" value="{{ $employeeDesignation }}">
                    </div>
                </div>
            </div>
            <div class="table-section">
                <table class="table">
                    <thead>
                        <tr>
                            <th>SL No.</th>
                            <th>Tools Name</th>
                            <th>Had Access</th>
                            <th>Access Removed</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($resignMasters as $tools)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $tools->employeeAccessTool->tool }}</td>
                            <td>{{ $tools->had_access ? 'Yes' : 'No' }}</td>
                            <td>{{ $tools->access_removed ? 'Yes' : 'No' }}</td>
                            <td>{{ $tools->remarks }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="signature-section">
                    <div class="signature">
                        @if ($checkedBySign)
                            <img src="{{ $checkedBySign }}" alt="Employee Sign">
                        @endif
                        <h3 class="signature-by">Received/Checked by</h3>
                    </div>
                    <div class="signature">
                        @if ($authorBySign)
                            <img src="{{ $authorBySign }}" alt="Employee Sign">
                        @endif
                        <h3 class="signature-by">Authorized by</h3>
                    </div>   
            </div>
        </div>
    </div>

</body>

</html>