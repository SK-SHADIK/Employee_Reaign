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
        border-radius: 0px;
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
        padding: 8px;
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
    }

    .btn-group {
  justify-content: center;
  display: flex;
  padding: 35px;
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
    justify-content: space-between;
    align-items: center;
    width: 1212px !IMPORTANT;
    margin: auto;
}
/* Styles for the popup container */
.popup {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.7);
  z-index: 9999;
}

/* Styles for the popup content */
.popup-content {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
}

/* Styles for the buttons inside the popup */
.popup-content button {
  margin: 5px;
}

.btn-reject {
  background-color: red;
  color: white;
}

.btn-cancel {
  background-color: #ccc;
  color: black;
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
            <div class="btn-group">
                <form action="/admin/update-approval-status" method="post">
                  @csrf
                  <input type="hidden" name="id" value="{{ $resignMasterId }}">
                  <button type="submit" class="btn btn-approve">Approve</button>
                </form>

                
                  <button class="btn btn-rejected">Reject</button>
                <!-- Modal -->
                <div id="popup" class="popup">
                  <div class="popup-content">
                    <h2>Confirmation</h2>
                        <form action="/admin/update-reject-status" method="post">
                          @csrf
                          <input type="hidden" name="id" value="{{ $resignMasterId }}">
                            <input class=>
                            <button type="submit" id="confirmReject" class="btn btn-reject">Yes, Reject</button>
                            <button id="cancelReject" class="btn btn-cancel">Cancel</button>
                        </form>
                  </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
<script>
  // Get the popup and buttons elements
  const popup = document.getElementById("popup");
  const confirmRejectBtn = document.getElementById("confirmReject");
  const cancelRejectBtn = document.getElementById("cancelReject");

  // Function to display the popup
  function showPopup() {
    popup.style.display = "block";
  }

  // Function to hide the popup
  function hidePopup() {
    popup.style.display = "none";
  }

  // Attach event listener to the Reject button to show the popup
  const rejectBtn = document.querySelector(".btn-rejected");
  rejectBtn.addEventListener("click", showPopup);

  // Attach event listener to the Cancel button to hide the popup
  cancelRejectBtn.addEventListener("click", hidePopup);

  // You can also handle the form submission here if needed
  confirmRejectBtn.addEventListener("click", function () {
    // Handle form submission, e.g., submit the form via AJAX or direct form submission
    // You can use JavaScript to submit the form or use any JavaScript framework like Axios or jQuery.
    // For example, you can use the following code to submit the form:
    // document.querySelector("form").submit();

    // After handling the form submission, hide the popup
    hidePopup();
  });
</script>
