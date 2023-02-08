

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Home</title>
    <link href="./CSSfiles/headerCss.css" rel="stylesheet" type="text/css">
    <link href="./CSSfiles/loginform.css" rel="stylesheet" type="text/css">
    <link href="./CSSfiles/sidebar.css" rel="stylesheet" type="text/css">
    <link href="./CSSfiles/ForTable.css" rel="stylesheet" type="text/css">

</head>

<?php include './header.php'; ?>

<section id="mainContent">
		<h2>Introduction</h2>
                <p>OneRP is a forum that focuses on bringing out everything in RP into One platform.
                <br>The website prioritizes on taking out all your queries, discussions, arguments, remarks and presenting itself into a single forum-based portal. <br>
                Being made for the students, OneRP depends on the students to build it up and to make it more effective and involving.</p>

	</section>

	<section>
    <table class="sidebar" width="200" border="0" cellpadding="10" >
      <tbody>
        <tr>
          <th scope="col" style="border-radius: 10px 10px 0px 0px">&nbsp;Recents topics</th>
        </tr>
<?php include './doSidebar.php'; ?>

      </tbody>
    </table>
    </section>

    <section class="icons">
    <table class="tborder" cellpadding="8" cellspacing="0" border="0" width="100%" align="center">

      <tbody>

        <tr align="center">
            <td>
                <a href="topics.php?category_id=4"><img src="./pics/Intro.png" style="width:80px;height:80px;"></a>

          </td>
            <td><a href="topics.php?category_id=1"><img src="./pics/laptop.png" style="width:80px;height:80px;"></a>

          </td>
            <td><a href="topics.php?category_id=2"><img src="./pics/letter.png" style="width:70px;height:70px;"></a>

          </td>
            <td><a href="topics.php?category_id=3"><img src="./pics/chair.png" style="width:75px;height:73px;"></a></td>

        </tr>
        <tr align="center">
          <td>
            <div>
              <a>Introductions</a><br>
              <font size="2">Dont be shy</font>
            </div>
          </td>
          <td>
            <div>
              <a>IT Support</a><br>
              <font size="2">Blue Screen?</font>
            </div>
          </td>
          <td>
            <div>
              <a>Confessions</a><br>
              <font size="2">Gambare!</font>
            </div>
          </td>
          <td>
            <div>
              <a>Study</a><br>
              <font size="2">Get your GPA up!</font>
            </div>
          </td>

        </tr>

      </tbody>
    </table>
  </section>





</body>
</html>

