<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Đăng ký thành công</title>
</head>
<style>
body {
    margin: 0;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
}

.banner {
    height: 100vh;
}

.banner-content {
    display: block;
    width: 100%;
    margin: auto;
    text-align: center;
}

.spinner-container {
    display: flex;
    justify-content: center;
}

.header {
    font-size: 7em;
    margin-top: 25vh;
}

.sub-header {
    font-size: 2em;
    margin-top: 2vh;
}

.dot-pulse {
  position: relative;
  left: -9999px;
  width: 50px;
  height: 50px;
  margin-top: 2vh;
  border-radius: 25px;
  background-color: #2eb82e;
  color: #2eb82e;
  box-shadow: 9999px 0 0 -5px #2eb82e;
  animation: dotPulse 1.5s infinite linear;
  animation-delay: .25s;
}

.dot-pulse::before, .dot-pulse::after {
  content: '';
  display: inline-block;
  position: absolute;
  top: 0;
  width: 50px;
  height: 50px;
  border-radius: 25px;
  background-color: #2eb82e;
  color: #2eb82e;
}

.dot-pulse::before {
  box-shadow: 9934px 0 0 -5px #2eb82e;
  animation: dotPulseBefore 1.5s infinite linear;
  animation-delay: 0s;
}

.dot-pulse::after {
  box-shadow: 10064px 0 0 -5px #2eb82e;
  animation: dotPulseAfter 1.5s infinite linear;
  animation-delay: .5s;
}

@keyframes dotPulseBefore {
  0% {
    box-shadow: 9934px 0 0 -5px #2eb82e;
  }
  30% {
    box-shadow: 9934px 0 0 2px #2eb82e;
  }
  60%,
  100% {
    box-shadow: 9934px 0 0 -5px #2eb82e;
  }
}

@keyframes dotPulse {
  0% {
    box-shadow: 9999px 0 0 -5px #2eb82e;
  }
  30% {
    box-shadow: 9999px 0 0 2px #2eb82e;
  }
  60%,
  100% {
    box-shadow: 9999px 0 0 -5px #2eb82e;
  }
}

@keyframes dotPulseAfter {
  0% {
    box-shadow: 10064px 0 0 -5px #2eb82e;
  }
  30% {
    box-shadow: 10064px 0 0 2px #2eb82e;
  }
  60%,
  100% {
    box-shadow: 10064px 0 0 -5px #2eb82e;
  }
}

</style>
<body>
    <div class="banner">
        <p class="banner-content header">Đăng ký thành công</p> 
        <p class="banner-content sub-header">Bạn sẽ được chuyển tiếp về trang đăng nhập trong giây lát</p>
        <div class="spinner-container">
            <div class="dot-pulse"></div>   
        </div>
    </div>
</body>
<script>
    $(document).ready(function () {
        setTimeout(function(){ window.location.replace("signin.php"); }, 2000);
    });
</script>
</html>