function fetch_select(val)
{
 $.ajax({
 type: 'post',
 url: 'getkabupaten.php',
 data: {
  get_option:val
 },
 success: function (response) {
  document.getElementById("new_select").innerHTML=response; 
 }
 });
}