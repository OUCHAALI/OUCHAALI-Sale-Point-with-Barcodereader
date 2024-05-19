<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <style>
    .coupon-container .close {
      width: 24px;
      position: absolute;
      top: 16px;
      right: 16px;
      z-index: 2;
      cursor: pointer;
    }

    .coupon-container {
      font-family: initial;
      max-width: 380px;
      text-align: center;
      background: #c4c4c4bd;
      opacity: 0;
      pointer-events: none;
      transform: translateY(30px);
      transition: all 400ms ease;
    }

    .coupon-container.active {
      opacity: 1;
      pointer-events: auto;
      transform: translateY(0);
    }

    .coupon-container .gift {
      position: absolute;
      width: 180px;
      top: -120px;
      left: 50%;
      transform: translateX(-50%);
    }

    .coupon-container .bg {
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
    }

    .coupon-container h2,
    .coupon-container p,
    .coupon-container .discount,
    .coupon-container .code,
    .coupon-container .btn {
      position: relative;
    }

    .coupon-container h2 {
      color: #8400d0;
      font-weight: 900;
      font-size: 38px;
      padding-top: 0px;
      margin-top: -4px;
    }

    .coupon-container p {
      font-size: 18px;
      color: #023047;
      margin: 8px;
    }

    .coupon-container .discount {
      font-family: "Poppins", sans-serif;
      font-size: 56px;
      font-weight: 300;
      color: #076170;
    }

    .coupon-container .code {
      font-size: 45px;
      font-weight: 900;
    }

    .coupon-container .btn {
      text-decoration: none;
      background: #e63946;
      padding: 16px;
      display: inline-block;
      width: 100%;
      color: #fff;
      box-sizing: border-box;
      margin-top: 24px;
      font-size: 24px;
      font-weight: 900;
      text-transform: uppercase;
      transition: all 300ms ease;
    }

    .coupon-container .btn:hover {
      background: #e22535;
    }

    .get-discount-btn {
      padding: 8px 32px;
      background: #023047;
      color: #fff;
      border: none;
      font-size: 18px;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="coupon-container active">
    <div class="products">
      <h2>Check out our latest products:</h2>
      <ul>
        <li>Product 1</li>
        <li>Product 2</li>
        <li>Product 3</li>
      </ul>
    </div>
    <img class="bg" src="" alt="" />
    <img class="gift" src="https://freesvg.org/img/secretlondon_red_present.png" alt="" />
    <h2>Congratulations!</h2>
    <p>You can get</p>
    <div class="discount">75% off</div>
    <p>Here is your code</p>
    <div class="code">LBSAVE75</div>
    <a href="#" class="btn">Visit us ASAP</a>
  </div>
</body>
</html>
