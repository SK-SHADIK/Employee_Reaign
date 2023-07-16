<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>

<style>
   .box{
        height: 70vh !important;
        display: flex;
        align-items: center;
    }
    .praava-color{
        color: #8A2061;
    }
    .info-box{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .campaign-title{
        font-weight: bold;
        margin: 20px 0px;
    }
    .btn-primary, .btn-info:hover{
        background-color: #8A2061;
        border: 3px solid #8A2061;
        border-radius: 10px;
    }
    .btn-info, .btn-primary:hover{
        background-color: #fff;
        color: #8A2061;
        border: 3px solid #8A2061;
        border-radius: 5px;
    }
</style>
<body>
    <div class="box col-8 mx-auto ">
        <div class="info-box">
        <div class="wc border-end">
        <lottie-player src="https://lottie.host/e55b5862-5ba9-431c-90a5-60a317cb0655/vVoHVOBewt.json" background="#FFFFFF" speed="1" style="width: 300px; height: 300px" direction="1" mode="normal" loop autoplay></lottie-player>
        </div>
        <div class="DashInfo border-start">
            <h1 class="campaign-title fw-bold mx-auto praava-color" >IT Check List for <br>Employee Clearance</h1>
            <!-- <div class="campaign-btns">
                <a href="" class="campaign-btn btn-primary btn btn-lg "></a>
                <a href="" class="campaign-btn btn-info btn  btn-lg "></a>
            </div> -->
        </div>
        </div>
    </div>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</body>
</html>