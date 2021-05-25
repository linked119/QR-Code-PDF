<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <title>CV</title>
  </head>

  <body>
    <style>
      * :not(dd) {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      header {
        padding: 0 10px;
        display: flex;
        justify-content: space-between;
      }

      header img {
        width: 100px;
      }

      header div small {
        display: block;
        text-align: left;
      }

      h3 {
        font-family: sans-serif;
        font-variant: small-caps;
        border-bottom: 3px solid black;
      }

      .personal-details {
        display: flex;
        justify-content: space-between;
        align-items: center;
      }

      .title {
        display: flex;
        justify-content: space-between;
      }

      .label {
        color: white;
        font-weight: bold;
        background-color: black;
        padding: 3px;
        font-size: 10px;
        border-radius: 3px;
      }

      .education-info,
      .work-experience-info {
        padding: 0 30px;
      }

      dt {
        font-style: italic;
      }
      dl dd{
          margin-top:10px;
          max-width:100%;
      }

      table tr td {
        vertical-align: top;
        padding: 0 10px;
      }

      button {
        color: white;
        font-family: "Open Sans";
        background-color: rgb(0, 142, 236);
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        margin: 20px;
        cursor: pointer;
      }
      .container{
        padding: 0 10px;
      }
      #container{
        padding: 0;
        display:flex;
        justify-content:flex-end;
      }
      .skills{
          padding: 0 30px;
      }
      body::-webkit-scrollbar{
          display:none;
      }
      .loader{
          position:fixed;
          width:100vw;
          height:100vh;
          background:white;
          display:flex;
          justify-content:center;
          align-items:center;
      }
    </style>
    <div class="loader">

<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: rgb(255, 255, 255); display: block; shape-rendering: auto;" width="211px" height="211px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
<g transform="rotate(0 50 50)">
  <rect x="47.5" y="19" rx="2.5" ry="2.52" width="5" height="12" fill="#74b869">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1.2048192771084336s" begin="-1.1121408711770158s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(27.692307692307693 50 50)">
  <rect x="47.5" y="19" rx="2.5" ry="2.52" width="5" height="12" fill="#74b869">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1.2048192771084336s" begin="-1.0194624652455977s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(55.38461538461539 50 50)">
  <rect x="47.5" y="19" rx="2.5" ry="2.52" width="5" height="12" fill="#74b869">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1.2048192771084336s" begin="-0.9267840593141797s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(83.07692307692308 50 50)">
  <rect x="47.5" y="19" rx="2.5" ry="2.52" width="5" height="12" fill="#74b869">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1.2048192771084336s" begin="-0.8341056533827618s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(110.76923076923077 50 50)">
  <rect x="47.5" y="19" rx="2.5" ry="2.52" width="5" height="12" fill="#74b869">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1.2048192771084336s" begin="-0.7414272474513438s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(138.46153846153845 50 50)">
  <rect x="47.5" y="19" rx="2.5" ry="2.52" width="5" height="12" fill="#74b869">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1.2048192771084336s" begin="-0.6487488415199258s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(166.15384615384616 50 50)">
  <rect x="47.5" y="19" rx="2.5" ry="2.52" width="5" height="12" fill="#74b869">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1.2048192771084336s" begin="-0.5560704355885079s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(193.84615384615384 50 50)">
  <rect x="47.5" y="19" rx="2.5" ry="2.52" width="5" height="12" fill="#74b869">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1.2048192771084336s" begin="-0.46339202965708987s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(221.53846153846155 50 50)">
  <rect x="47.5" y="19" rx="2.5" ry="2.52" width="5" height="12" fill="#74b869">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1.2048192771084336s" begin="-0.3707136237256719s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(249.23076923076923 50 50)">
  <rect x="47.5" y="19" rx="2.5" ry="2.52" width="5" height="12" fill="#74b869">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1.2048192771084336s" begin="-0.27803521779425394s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(276.9230769230769 50 50)">
  <rect x="47.5" y="19" rx="2.5" ry="2.52" width="5" height="12" fill="#74b869">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1.2048192771084336s" begin="-0.18535681186283595s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(304.61538461538464 50 50)">
  <rect x="47.5" y="19" rx="2.5" ry="2.52" width="5" height="12" fill="#74b869">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1.2048192771084336s" begin="-0.09267840593141798s" repeatCount="indefinite"></animate>
  </rect>
</g><g transform="rotate(332.3076923076923 50 50)">
  <rect x="47.5" y="19" rx="2.5" ry="2.52" width="5" height="12" fill="#74b869">
    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1.2048192771084336s" begin="0s" repeatCount="indefinite"></animate>
  </rect>
</g>
<!-- [ldio] generated by https://loading.io/ --></svg>
    </div>
    <div class="container">
      <br>
      <header>
        <div>
          <h1><?php echo $_REQUEST["name"]?></h1>
          <!--<small><?php //echo $_REQUEST["designation"]?></small>-->
          <br/>
          <p><i class="far fa-envelope"></i> <?php echo $_REQUEST["email"]?></p>
          <p><i class="fas fa-phone-alt"></i> <?php echo $_REQUEST["phone"]?></p>
        </div>
        <div id="container"></div>
      </header>
      <br />
      <!-- <h3>Personal Details</h3>
      <br />
      <section>
        <div class="personal-details">
          <div>
            <pre>
  
      <em>Birth</em>         January 1, 1980
      <i>Address</i>       111 First St, New York
      <em>Phone</em>         (123) 000-0000
      <i>Mail</i>          me@home.com
            </pre>
          </div>-->
          
        <!--
        </div>
      </section> -->
      <h3>Education</h3>
      <br />
      <section class="education-info">
      <?php
        for ($i=0; $i < count($_REQUEST["education_title"]); $i++):
      ?>
        <div class="title">
          <h4><?php echo $_REQUEST["education_title"][$i]?></h4>
          <p class="label"><?php echo $_REQUEST["date"][$i]?></p>
        </div>
        <dl>
          <dt><?php echo $_REQUEST["university_name"][$i]?></dt>
          <dd>
              
          </dd>
        </dl>
        <br />
        <?php
            endfor;
        ?>
        </section>
        <h3>Work EXPERIENCE</h3>
      <br />
      <section class="work-experience-info">
      <?php
         for ($i=0; $i < count($_REQUEST["work_title"]); $i++):
      ?>
        <div class="title">
          <h4><?php echo $_REQUEST["work_title"][$i]?></h4>
          <p class="label"><?php echo $_REQUEST["work_date"][$i]?></p>
        </div>
        <dl>
          <dd>
            <?php echo $_REQUEST["work_desc"][$i]?>
          </dd>
        </dl>
        <br />
        <?php
            endfor;
        ?>
      </section>
      <br />
      <h3>Skills</h3>
      <br />
      <section class="skills">
      <?php
        for ($i=0; $i < count($_REQUEST["skills"]); $i++):
      ?>
            <dl>
                <dt>
                    <?php echo $_REQUEST["skills"][$i]?>
                </dt>            
            </dl>
      <?php
        endfor;
      ?>
      </section>
    </div>
    <button onclick="download();">Download PDF</button>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" referrerpolicy="no-referrer"></script>
    <script src="qrcode-svg/lib/qrcode.js"></script>
    <script>

      var qrcode = new QRCode({ content: "<?php echo $_REQUEST["link"]?>", join: true, width: 100,  height: 100, });
      var svg = qrcode.svg();
      document.getElementById("container").innerHTML = svg;
      window.onload=()=>{
        html2pdf().from(document.querySelector(".container")).save();
        setTimeout(()=>{
            close();
        },500);
      }
    </script>
  </body>
</html>
