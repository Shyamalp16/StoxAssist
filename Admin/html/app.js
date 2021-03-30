$(document).ready(function(){
    $.ajax({
        url:"http://localhost/StoxAssist/Admin/html/data.php",
        method:"GET",
        success: function(data){
            console.log(data);
            var name = [];
            var qty = [];

            for(var i in data){
                name.push("Product "+ data[i].name);
                qty.push(data[i].qty);
            }
            console.log(name[0]);
            console.log(qty[0]);
            var chartData = {
                labels:name,
                datasets: [
                    {
                        label:'Product Name',
                        backgroundColor:'rgba(200,200,200,0.75)',
                        borderColor:'rgba(200,200,200,0.75)',
                        hoverBackgroundColor:'rgba(200,200,200,1)',
                        hoverBorderColor:'rgba(200,200,200,1)',
                        data:qty
                    }
                ]
            };

            var ctx = $("#myBarChart");
            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartData
            });
        },
        error:function(data){
            console.log(data);
        }
    })
});