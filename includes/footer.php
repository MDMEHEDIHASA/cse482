<footer class="border-top text-center small text-muted py-3">
        <p class="m-0">Copyright &copy; 2021 <a href="/" class="text-muted">Blog</a>. All rights reserved.</p>
      </footer>
      
      <script type="text/javascript">
      // Live Search
     $("#search_text_input").on("keyup",function(){
       var search_term = $(this).val();

       $.ajax({
         url: "includes/handlers/ajaxLiveSearch.php",
         type: "POST",
         data : {search:search_term },
         success: function(data) {
           $("#search_results").html(data);
         }
       });
     });
    </script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>