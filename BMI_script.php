<script>
var age = document.getElementById("age");
var feet = document.getElementById("feet");
var inches = document.getElementById("inches");
var weight = document.getElementById("weight");
var result = document.getElementById("result");

function validate(event) {
  event.preventDefault();
  $returnvalue = true;
  let height_regex = /^[0-9]/;

  if (!height_regex.test(age.value)) {
    let ageerror = document.getElementById("ageerror");
    ageerror.innerText = "*Enter your Age properly";
    $returnvalue = false;

  }
  if (age.value != "" && height_regex.test(age.value)) {
    let ageerror = document.getElementById("ageerror");
    ageerror.innerText = "";
    $returnvalue = true;
  }
  if (!height_regex.test(feet.value)) {
    let heighterror = document.getElementById("heighterror");
    heighterror.innerText = "*Enter your height";
    $returnvalue = false;
  }
  if (!height_regex.test(inches.value)) {
    let heighterror = document.getElementById("heighterror");
    heighterror.innerText = "*Enter your height properly Both fields are required";
    $returnvalue = false;
  }
  if (feet.value != "" && height_regex.test(feet.value)) {
    if (inches.value != "" && height_regex.test(inches.value)) {
      let heighterror = document.getElementById("heighterror");
      heighterror.innerText = "";
      $returnvalue = true;
    }
  }
  if (!height_regex.test(weight.value)) {
    let weighterror = document.getElementById("weighterror");
    weighterror.innerText = "*Enter your weight";
    $returnvalue = false;
  }
  if (weight.value != "" && height_regex.test(weight.value)) {
    let weighterror = document.getElementById("weighterror");
    weighterror.innerText = "";
    $returnvalue = true;
  }
  check();
  return $returnvalue;
}
function check() {
  var height = (parseFloat((feet.value) * 12) + parseFloat(inches.value));
  var weight_lbs = ((parseFloat(weight.value) * 2.20462));
  result.value = ((parseFloat(weight_lbs) / (height * height)) * 703).toFixed(2);
  //BMI = weight (lb) ÷ (height (inches)) 2 × 703

  $.ajax({
    url:"ajax-insert.php",
    type:"POST",
    data : {age:age.value, feet:feet.value, inches:inches.value, weight:weight.value, result:result.value},
    success: function(data){
        console.log("insert successfully");
      }
  });
  create_chart();
}
function create_chart() {
  am5.ready(function () {

    // Create root element
    // https://www.amcharts.com/docs/v5/getting-started/#Root_element
    var root = am5.Root.new("chartdiv");


    // Set themes
    // https://www.amcharts.com/docs/v5/concepts/themes/
    root.setThemes([
      am5themes_Animated.new(root)
    ]);


    // Create chart
    // https://www.amcharts.com/docs/v5/charts/xy-chart/
    var chart = root.container.children.push(am5xy.XYChart.new(root, {
      panX: false,
      panY: false,
      wheelX: "none",
      wheelY: "none",
      layout: root.verticalLayout,
      paddingRight: 30
    }));


    // Add legend
    // https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
    var legend = chart.children.push(
      am5.Legend.new(root, {
        centerX: am5.p50,
        x: am5.p50
      })
    );

    data = [];
    true_false = [];
    color1 = [];
    var BMI = (Math.round(result.value));
    var i;
    true_false[i] = false;
    for (var i = 0; i < 100; i++) {
      if (i === BMI) {
        true_false[i] = true;
      } else {
        true_false[i] = false;
      }


      if (i >= 1 && i < 18.5) {
        color1[i] = am5.color(0xc6251a);
      }
      else if (i >= 18.5 && i < 25) {
        color1[i] = am5.color(0xFF8C00);
      }
      else if (i >= 25 && i < 30) {
        color1[i] = am5.color(0x6bc352);
      }
      else if (i >= 30) {
        color1[i] = am5.color(0xfcc034);
      }
    }
    for (var i = 0; i < 100; i++) {
      data.push({
        category: i,
        value: 100,
        currentBullet: true_false[i],
        columnSettings: {
          fill: color1[i]
        }
      });
    }

    
    // Create axes
    // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
    var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
      categoryField: "category",
      renderer: am5xy.AxisRendererX.new(root, {

      }),
      tooltip: am5.Tooltip.new(root, {})
    }));

    var xRenderer = xAxis.get("renderer");

    xRenderer.grid.template.set("forceHidden", true);
    xRenderer.labels.template.set("forceHidden", true);

    xAxis.data.setAll(data);

    var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
      min: 0,
      max: 1000,
      strictMinMax: true,
      renderer: am5xy.AxisRendererY.new(root, {})
    }));

    var yRenderer = yAxis.get("renderer");

    yRenderer.grid.template.set("forceHidden", true);
    yRenderer.labels.template.set("forceHidden", true);


    // Add series
    // https://www.amcharts.com/docs/v5/charts/xy-chart/series/

    var series = chart.series.push(am5xy.ColumnSeries.new(root, {
      xAxis: xAxis,
      yAxis: yAxis,
      valueYField: "value",
      categoryXField: "category",
      maskBullets: false
    }));

    series.columns.template.setAll({
      //tooltipText: "{categoryX}: {valueY}",
      width: am5.p100,
      tooltipY: 0,
      strokeOpacity: 1,
      strokeWidth: 2,
      stroke: am5.color(0xffffff),
      templateField: "columnSettings"
    });

    series.bullets.push(function (root, target, dataItem) {
      if (dataItem.dataContext.currentBullet) {
        var container = am5.Container.new(root, {});

        var pin = container.children.push(am5.Graphics.new(root, {
          fill: dataItem.dataContext.columnSettings.fill,
          dy: -5,
          centerY: am5.p100,
          centerX: am5.p50,
          svgPath: "M66.9 41.8c0-11.3-9.1-20.4-20.4-20.4-11.3 0-20.4 9.1-20.4 20.4 0 11.3 20.4 32.4 20.4 32.4s20.4-21.1 20.4-32.4zM37 41.4c0-5.2 4.3-9.5 9.5-9.5s9.5 4.2 9.5 9.5c0 5.2-4.2 9.5-9.5 9.5-5.2 0-9.5-4.3-9.5-9.5z"
        }));

        var label = container.children.push(am5.Label.new(root, {
          text: dataItem.get("categoryX"),
          dy: -38,
          centerY: am5.p50,
          centerX: am5.p50,
          populateText: true,
          paddingTop: 5,
          paddingRight: 5,
          paddingBottom: 5,
          paddingLeft: 5,
          background: am5.RoundedRectangle.new(root, {
            fill: am5.color(0xffffff),
            cornerRadiusTL: 20,
            cornerRadiusTR: 20,
            cornerRadiusBR: 20,
            cornerRadiusBL: 20,
          })
        }));

        return am5.Bullet.new(root, {
          locationY: 1,
          sprite: container
        });
      }
      else if (dataItem.dataContext.targetBullet) {
        var container = am5.Container.new(root, {
          dx: 15
        });

        var circle = container.children.push(am5.Circle.new(root, {
          radius: 34,
          fill: am5.color(0x11326d),
        }));

        var label = container.children.push(am5.Label.new(root, {
          text: "GOAL\n[bold]ZERO[/]",
          textAlign: "center",
          //fontSize: "10",
          fill: am5.color(0xffffff),
          centerY: am5.p50,
          centerX: am5.p50,
          populateText: true,
        }));
        return am5.Bullet.new(root, {
          locationY: 0.5,
          sprite: container
        });
      }
      return false;
    });

    series.data.setAll(data);

    // Add labels
    function addAxisLabel(category, text) {
      var rangeDataItem = xAxis.makeDataItem({
        category: category
      });

      var range = xAxis.createAxisRange(rangeDataItem);

      range.get("label").setAll({
        //fill: am5.color(0xffffff),
        text: text,
        forceHidden: false
      });

      range.get("grid").setAll({
        //stroke: color,
        strokeOpacity: 1,
        location: 1
      });
    }

    addAxisLabel("2", "UW");
    addAxisLabel("20", "N");
    addAxisLabel("27", "OW");
    addAxisLabel("36", "O");


    // Make stuff animate on load
    // https://www.amcharts.com/docs/v5/concepts/animations/
    series.appear(1000, 100);
    chart.appear(1000, 100);

  }); // end am5.ready()
}
</script>
