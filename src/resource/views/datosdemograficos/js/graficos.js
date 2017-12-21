

$.ajax({
  type:"POST",
  url: "https://grupo36.proyecto2017.linti.unlp.edu.ar/application/datosdemograficos/getEstadisticaTipoAgua",
  dataType: "json",
  success:function(demogr){
    for (var i = 0; i < demogr.length; i++) {
      grafico.series[0].data.push({
        'name': demogr[i].tipo,
        'y':demogr[i].cantidad,
        'drilldown':demogr[i].tipo
      });
    }
    Highcharts.chart('container', grafico);
  },
  error:function(xhr,err,e){
    alert("Error: " + err + xhr + e);
  }
});

$.ajax({
  type:"POST",
  url: "https://grupo36.proyecto2017.linti.unlp.edu.ar/application/datosdemograficos/getEstadisticaMascota",
  dataType: "json",
  success:function(mascota){

    grafico2.series[0].data.push({name: 'Tiene Mascota', y: mascota.si });
    grafico2.series[0].data.push({name: 'Sin Mascota', y: mascota.no });

    Highcharts.chart('container2', grafico2);
  },
  error:function(xhr,err,e){
    alert("Error: " + err + xhr + e);
  }
});




var grafico2 = {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Graficos de cantidad de mascotas'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: []
    }]
};

var grafico = {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Gráfico de tipos de agua'
    },
    subtitle: {
        text: 'Datos estadísticos de tipos de agua en viviendas de pacientes.'
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Total Pacientes'
        }

    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}'
            }
        }
    },

    series: [{
        name: 'Tipos de Agua',
        colorByPoint: true,
        data: []
    }]
};
