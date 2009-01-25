<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">
  <title>UBBT Journal Requirement</title>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js" type="text/javascript" charset="utf-8"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.5.3/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
  <link rel="stylesheet" href="reset.css" type="text/css" charset="utf-8"/>
  <style type="text/css" media="screen">
    body {
      font: medium/1.5em Helvetica, Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    
    h1 { font-size:2.25em;  /* 16x2.25=36 */ }
    h2 { font-size:1.5em;   /* 16x1.5=24 */ }
    h3 { font-size:1.125em; /* 16x1.125=18 */ }
    h4 { font-size:0.875em; /* 16x0.875=14 */ }
    p  { font-size:0.75em;  /* 16x0.75=12 */ }
    
    #page {
      font-size: 100%;
      width: 59em; /* 976.0px at 16px base – with a 1em padding*/
      margin: 0 auto;
      padding: 1em;
/*      background: url('images/grid.png') repeat-y; /* grid - remove */*/
      overflow: auto;
    }
    
    h1 { 
      margin-bottom: 0.444em; /* 16.0px at 36px base */
    }
    
    h1 img {
      width: 13.667em; /* 492.0px at 36px base */
    }
    
    .about {
      font-size: 1.125em;
      width: 30.222em; /* 544.0px at 18px base */
      font-weight: normal;
      margin-bottom: 1.778em; /* 32.0px at 18px base */
    }
    
    h3.information-heading {
      height: 1.778em; /* 32.0px at 18px base */
      background: url('images/bottom-white-grad.png') repeat-x bottom;
      line-height: 0.1em;
      position: relative;
    }
    
    h3.information-heading img {
      width: 1.333em; /* 24.0px at 18px base */
      margin: 0.2em 1.111em; /* 20.0px at 18px base */
      vertical-align: -0.5em;
    }
    
    h3.information-heading span {
      font-size: 0.667em; /* 12.0px at 18px base */
      right: 1em;
      margin-top: 1.3em;
      position: absolute;
    }
    
    #member-groupings {
      width: 39em;
      float: left;
    }
    
    #member-groupings div {
      margin-bottom: 2em;
    }
        
    #member-groupings #on-target h3 {
      background-color: #92c076;
    }
    
    #member-groupings #falling-behind h3 {
      background-color: #ece54d;
    }

    #member-groupings #no-entries h3 {
      background-color: #f36f65;
    }
    
    .member-collection {
      background: white url('images/top-black-grad.png') repeat-x top;
      border: 1px solid #aaa;
      border-top: none;
    }
    
    #spotlight {
      width: 14em;
      float: right;
    }
    
    #spotlight h3 {
      text-align: center;
      background-color: #f1ea51;
    }
    
    #spotlight h3 img {
      margin: 0.2em 0.2em;
    }
  </style>
</head>
<body id="nag">
  <div id="page">
    <h1><img src="images/ubbt-journal-reqs.png" alt="Ubbt Journal Requirment"/></h1>
    <p class="about">Every UBBT participant is required to make a weekly journal entry on the UBBT web site. Find someone who is falling behind, and help them by sending a friendly email.</p>
    
    <div id="member-groupings">
      <div id="on-target">
        <h3 class="information-heading">
          <img src="images/green-check.png" alt="Green Check"/>
          12 Members are on target &ndash; an entry in the past week 
          <span>[ <a href="#on-target">show</a> ]</span>
        </h3>
        
        <div class="member-collection"></div>
      </div>

      <div id="falling-behind">
        <h3 class="information-heading">
          <img src="images/yellow-bang.png" alt="Yellow Exclamation"/>
          12 Members are falling behind &ndash; Some entries
          <span>[ <a href="#falling-behind">show</a> ]</span>
        </h3>
        
        <div class="member-collection"></div>
      </div>

      <div id="no-entries">
        <h3 class="information-heading">
          <img src="images/red-x.png" alt="Red X"/>
          12 Members have no entries yet
          <span>[ <a href="#no-entries">show</a> ]</span>
        </h3>
        
        <div class="member-collection">
          Something<br/>
          Something<br/>
          Something<br/>
        </div>
      </div>
    </div> <!-- #member-groupings -->
    
    <div id="spotlight">
      <h3 class="information-heading"><img src="images/yellow-star.png" alt="Yellow Star"/> Spotlight</h3>
    </div>
  </div>
  
  <script type="text/javascript" charset="utf-8">
    $(function() {
      $(".member-collection").hide();
      
      $("h3.information-heading a").click(function() {
        var div = $(this).parents("div").children("div:first");
        div.toggle();
        if ($(this).html() == "hide") {
          document.location.hash = "";
          $(this).html("show");
        }
        else {
          $(this).html("hide");
        }
      });
      
      if (document.location.hash) {
        $(document.location.hash).find("h3.information-heading a").click();
      }
    });
  </script>
</body>
</html>