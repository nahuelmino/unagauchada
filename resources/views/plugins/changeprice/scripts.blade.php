<script>
    function updatePrice(costoUni)
    {
        var cant = Number($("#cantidad").val());
        var total = Number(costoUni) * cant;
        $("#totalPrice").text(total);
    }
</script>