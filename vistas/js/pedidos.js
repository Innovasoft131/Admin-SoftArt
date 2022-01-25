$(document).on("click", ".btnViewPedido", function(){
    var pedido = $(this).attr("pedido");
    window.location = "index.php?ruta=viewPedido&pedido="+pedido;
});