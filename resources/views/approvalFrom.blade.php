<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Reaign</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/common.css')}}">
</head>

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
                          <div class="details">
                            <label class="title-name">Rejected Reason <span style="color: red;">*</span></label>
                            <input style="border: 2px solid #000;" name="rejected_reason" required>
                          </div><br><br><br>
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
  const popup = document.getElementById("popup");
  const confirmRejectBtn = document.getElementById("confirmReject");
  const cancelRejectBtn = document.getElementById("cancelReject");

  function showPopup() {
    popup.style.display = "block";
  }

  function hidePopup() {
    popup.style.display = "none";
  }

  const rejectBtn = document.querySelector(".btn-rejected");
  rejectBtn.addEventListener("click", showPopup);

  cancelRejectBtn.addEventListener("click", hidePopup);

  confirmRejectBtn.addEventListener("click", function () {
    hidePopup();
  });
</script>
