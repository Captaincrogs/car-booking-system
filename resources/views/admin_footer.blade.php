 {{-- end modal --}}

 <footer class="py-4 bg-light mt-auto">

</footer>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script type="text/javascript" src="{{ URL::asset('js/scripts.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/datatables-simple-demo.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>
<script>
$(document).ready(function() {
    $(document).on("click", ".edit", function() {
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        console.log(data);

        $('#brnd').val(data[0]);
        $('#mdl').val(data[1]);
        $('#lcp').val(data[3]);
        $('#gps').val(data[4]);
        $('#car_id').val(data[5]);
    });
});

//ajax call to controller
// function deleteCar(id) {
//     $.ajax({
//         type: 'get',
//         url: '/admin/newcars/delete/' + id,
//         success: function(data) {
//             console.log(data);
//             location.reload();
//         }
//     });
// }
</script>


</html>
@else
<div>
<h1>You are not authorized to access this page {{ Auth::user()->name }} :)</h1>
</div>
@endif

</html>
