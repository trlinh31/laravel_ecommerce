// $(document).ready(function () {
//     $("#addToCart").on("click", function () {
//         var size = $('select[name="size"]').val();
//         var color = $('select[name="color"]').val();
//         var qty = $('input[name="qty"]').val();
//         var product_id = $(this).data("id");
//         $.ajax({
//             type: "GET",
//             url: `/cart/add/${product_id}`,
//             data: {
//                 qty: qty,
//                 size: size,
//                 color: color,
//             },
//             success: function (response) {
//                 console.log(response);
//             },
//         });
//     });
// });
