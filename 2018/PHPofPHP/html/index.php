<html>
<head>
  <title>History of PHP</title>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/default.min.css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
  <script type="text/javascript">
    function view(){
      fetch('web-php/'+document.querySelector('#version').value)
      .then(r=>r.text())
      .then(function(r){
        document.querySelector('code').textContent=r;
        hljs.initHighlighting.called = false;
        hljs.initHighlighting();
      });
    }

    function diff(){
      fetch("diff.php", {
        method: "POST",
        body: JSON.stringify({"version": document.querySelector('#version').value})
      })
      .then(r=>r.text())
      .then(r=>document.querySelector('code').textContent=r);
    }
  </script>
</head>
<body style="background: skyblue">
  <div style="text-align:center;">
    <div style="border: 5px dotted navy; margin:0 auto; width:800px;">
      <marquee><h1>History of PHP</h1></marquee>
      <select id="version">
<?php
  chdir("web-php");
  $versions = glob("*/index");
  $n = count($versions);
  foreach(array_reverse($versions) as $filename){
    echo "<option value='$filename'>Version $n</option>";
    $n--;
  }
?>
      </select>
      <p>
        <button onclick="view()">View</button>
        <button onclick="diff()">Diff</button>
      </p>
      <pre>
        <code style="text-align: left; overflow:scroll; height:600px;" class="php hljs">
        </code>
      </pre>
    </div>
  </body>
</html>