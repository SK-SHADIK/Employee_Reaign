<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Reaign</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
</head>

<body>
    <div class="employee-reaign">
        <div class="header">
            <img src="Assets/Images/logo.jpeg" alt="">
            <p class="address">Plot # 09, Road # 17, Block # C, Banani, Dhaka-1213</p>
            <h3 class="title">IT Check List for Employee Clearance</h3>
        </div>
        <div class="employee-details">
            <div class="em-details">
                <div class="details">
                    <h3 class="title-name">Date</h3>
                    <input type="text">
                </div>
                <div class="details">
                    <h3 class="title-name">Name</h3>
                    <input type="text">
                </div>
                <div class="details">
                    <h3 class="title-name">EID</h3>
                    <input type="text">
                </div>
            </div>
            <div class="em-details">
                <div class="details">
                    <h3 class="title-name">Contact No</h3>
                    <input type="text">
                </div>
                <div class="details">
                    <h3 class="title-name">Address</h3>
                    <input type="text">
                </div>
            </div>
        </div>
        <div class="table-section">
            <table class="table">
                <thead>
                    <tr>
                        <th>Sl No.</th>
                        <th>Tools Name</th>
                        <th>Had Access</th>
                        <th>Access Removed</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>01</td>
                        <td>HIS</td>
                        <td>Yes</td>
                        <td>Yes</td>
                        <td> </td>
                    </tr>
                    <tr>
                        <td>02</td>
                        <td>EPT</td>
                        <td>Yes</td>
                        <td>Yes</td>
                        <td> </td>
                    </tr>
                    <tr>
                        <td>03</td>
                        <td>APPOINTMENT TOOL</td>
                        <td>Yes</td>
                        <td>Yes</td>
                        <td> </td>
                    </tr>
                    <tr>
                        <td>04</td>
                        <td>EMAIL</td>
                        <td>Yes</td>
                        <td>Yes</td>
                        <td>Checked By HR </td>
                    </tr>
                    <tr>
                        <td>05</td>
                        <td>LAPTOP / PC</td>
                        <td>Yes</td>
                        <td>Yes</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>06</td>
                        <td>CHARGER</td>
                        <td>Yes</td>
                        <td>Yes</td>
                        <td> </td>
                    </tr>
                    <tr>
                        <td>07</td>
                        <td>MOUSE</td>
                        <td>Yes</td>
                        <td>Yes</td>
                        <td> </td>
                    </tr>
                    <tr>
                        <td>08</td>
                        <td>METABASE</td>
                        <td>Yes</td>
                        <td>Yes</td>
                        <td> </td>
                    </tr>
                    <tr>
                        <td>09</td>
                        <td>CLOUD SERVER</td>
                        <td>Yes</td>
                        <td>Yes</td>
                        <td> </td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>CCTV CAMERA</td>
                        <td>Yes</td>
                        <td>Yes</td>
                        <td> </td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td>ACCESS CARD / ATTENDENCE SYSTEM</td>
                        <td>Yes</td>
                        <td>Yes</td>
                        <td> </td>
                    </tr>
                    <tr>
                        <td>12</td>
                        <td>VPN</td>
                        <td>Yes</td>
                        <td>Yes</td>
                        <td> </td>
                    </tr>
                    <tr>
                        <td>13</td>
                        <td>Device MAC Authentication (ACL)</td>
                        <td>Yes</td>
                        <td>Yes</td>
                        <td> </td>
                    </tr>
                    <tr>
                        <td>14</td>
                        <td>Call Center (CC)</td>
                        <td>Yes</td>
                        <td>Yes</td>
                        <td> </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="signature-section">
            <div class="signature">
                <img src="Assets/Images/logo.jpeg" alt="">
                <h3 class="signature-by">Received by</h3>
            </div>
            <div class="signature">
                <img src="Assets/Images/logo.jpeg" alt="">
                <h3 class="signature-by">Checked by</h3>
            </div>
            <div class="signature">
                <img src="Assets/Images/logo.jpeg" alt="">
                <h3 class="signature-by">Authorized by</h3>
            </div>
        </div>
    </div>

</body>
</html>

<style>
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
        height: 80px;
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
</style>