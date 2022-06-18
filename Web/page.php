
<!DOCTYPE html>
<html>
    <head>
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <?php
      include("congfig.php");
    ?>
    <style>
      .table-response{
        box-shadow: 10px 6px 10px 10px rgba(44, 38, 41, 0.1);
        border-radius: 10px;
        background-color: white;
      }
      body{
        background-color: rgb(255, 255, 254);
      }
    </style>
    <body>
        <div class="container">
            <h3 align="center">Countries And Currencies</h3>
              <div class="input-group mb-3" style="width:45%">
                <input id="keywords" type="text" class="form-control" aria-label="Sizing example input" placeholder="Search" aria-describedby="inputGroup-sizing-default" onkeyup="searchFilter()">
              </div>
            <div class="table-response">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                          <th>Country</th>
                          <th>Currency</th>
                          <th>Currency Code</th>
                          <th>Symbol</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <li class="page-item">
                  <a id="1" class="page-link" href="page.php?page=1" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
                <?php for($i = 1; $i <= $pages; $i++) : ?>
                  <li class="page-item"><a id="<?= $i; ?>" class="page-link page" onclick="fetch_data()" href="page.php?page=<?= $i; ?>"><?= $i; ?></a></li>
                <?php endfor; ?>
                <li class="page-item">
                  <a id="<?= $pages; ?>" class="page-link" href="page.php?page=<?= $pages; ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              </ul>
            </nav>
        </div>
        <div id="page"></div>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
<script type="text/javascript">
  $(document).ready(function(){
    fetch_data();
    function fetch_data() {
        let urlstr = window.location.href;
        var result = new RegExp('[\?&]' + 'page' + '=([^&#]*)').exec(urlstr);
        var id = decodeURI(result[1] || 0);
        console.log(id);
        var action = "fetch_page"
        $.ajax({
            url:"pagination.php",
            method:"POST",
            data:{id:id},
            success:function(data) {
                $('tbody').html(data);
            }
        })
    }
 });
 function searchFilter() {
    var keywords = $('#keywords').val();
    console.log(keywords)
    $.ajax({
        url: 'getData.php',
        method: 'POST',
        data:{keywords:keywords},
        success: function (data) {
            $('tbody').html(data);
        }
    });
}
</script>