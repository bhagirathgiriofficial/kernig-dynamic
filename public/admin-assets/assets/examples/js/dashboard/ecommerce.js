(function (global, factory) {
  if (typeof define === "function" && define.amd) {
    define('/dashboard/ecommerce', ['jquery', 'Site'], factory);
  } else if (typeof exports !== "undefined") {
    factory(require('jquery'), require('Site'));
  } else {
    var mod = {
      exports: {}
    };
    factory(global.jQuery, global.Site);
    global.dashboardEcommerce = mod.exports;
  }
})(this, function (_jquery, _Site) {
  'use strict';

  var _jquery2 = babelHelpers.interopRequireDefault(_jquery);

  (0, _jquery2.default)(document).ready(function ($$$1) {
    (0, _Site.run)();

    (function () {
      //scoreChart start
      //
      (function () {
        var scoreChart = function scoreChart(id, labelList, series1List, series2List) {

          var scoreChart = new Chartist.Line('#' + id, {
            labels: labelList,
            series: [series1List, series2List]
          }, {
            lineSmooth: Chartist.Interpolation.simple({
              divisor: 2
            }),
            fullWidth: true,
            chartPadding: {
              right: 25
            },
            series: {
              "series-1": {
                showArea: true
              },
              "series-2": {
                showArea: true
              }
            },
            axisX: {
              showGrid: false
            },
            axisY: {
              labelInterpolationFnc: function labelInterpolationFnc(value) {
                return value / 1000 + 'K';
              },
              scaleMinSpace: 40
            },
            plugins: [Chartist.plugins.tooltip()],
            low: 0,
            height: 300
          });
          scoreChart.on('created', function (data) {
            var defs = data.svg.querySelector('defs') || data.svg.elem('defs');
            var width = data.svg.width();
            var height = data.svg.height();

            var filter = defs.elem('filter', {
              x: 0,
              y: "-10%",
              id: 'shadow' + id
            }, '', true);

            filter.elem('feGaussianBlur', { in: "SourceAlpha",
              stdDeviation: "8",
              result: 'offsetBlur'
            });
            filter.elem('feOffset', {
              dx: "0",
              dy: "10"
            });

            filter.elem('feBlend', { in: "SourceGraphic",
              mode: "multiply"
            });

            return defs;
          }).on('draw', function (data) {
            if (data.type === 'line') {
              data.element.attr({
                filter: 'url(#shadow' + id + ')'
              });
            } else if (data.type === 'point') {

              var parent = new Chartist.Svg(data.element._node.parentNode);
              parent.elem('line', {
                x1: data.x,
                y1: data.y,
                x2: data.x + 0.01,
                y2: data.y,
                "class": 'ct-point-content'
              });
            }
            if (data.type === 'line' || data.type == 'area') {
              data.element.animate({
                d: {
                  begin: 100 * data.index,
                  dur: 100,
                  from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                  to: data.path.clone().stringify(),
                  easing: Chartist.Svg.Easing.easeOutQuint
                }
              });
            }
          });
        };

        var DayLabelList = ["1st", "2nd", "3rd", "4th", "5th", "6th", "7th"];
        var DaySeries1List = {
          name: "series-1",
          data: []
        };
        var DaySeries2List = {
          name: "series-2",
          data: []
        };

        var WeekLabelList = ["W1", "W2", "W4", "W5", "W6", "W7", "W8"];
        var WeekSeries1List = {
          name: "series-1",
          data: []
        };
        var WeekSeries2List = {
          name: "series-2",
          data: []
        };

        var MonthLabelList = ["AUG", "SEP", "OTC", "NOV", "DEC", "JAN", "FEB"];
        var MonthSeries1List = {
          name: "series-1",
          data: []
        };
        var MonthSeries2List = {
          name: "series-2",
          data: []
        };

        var createChart = function createChart(button) {
          var btn = button || $$$1("#ecommerceChartView .chart-action").find(".active");
          console.log(btn);

          var chartId = btn.attr("href");
          switch (chartId) {
            case "#scoreLineToDay":
              scoreChart("scoreLineToDay", DayLabelList, DaySeries1List, DaySeries2List);
              break;
            case "#scoreLineToWeek":
              scoreChart("scoreLineToWeek", WeekLabelList, WeekSeries1List, WeekSeries2List);
              break;
            case "#scoreLineToMonth":
              scoreChart("scoreLineToMonth", MonthLabelList, MonthSeries1List, MonthSeries2List);
              break;
          }
        };

        createChart();
        $$$1(".chart-action li a").on("click", function () {
          createChart($$$1(this));
        });
      })();

      //barChart start
      (function () {
        var barChart = new Chartist.Bar('.barChart', {
          labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY'],
          series: [[630, 700, 500, 400, 780], [400, 800, 700, 500, 700]]
        }, {
          axisX: {
            showGrid: false
          },
          axisY: {
            showGrid: false,
            scaleMinSpace: 30
          },
          height: 220,
          seriesBarDistance: 24
        });

        barChart.on('draw', function (data) {
          if (data.type === 'bar') {

            // $("#ecommerceRevenue .ct-labels").attr('transform', 'translate(0 15)');
            var parent = new Chartist.Svg(data.element._node.parentNode);
            parent.elem('line', {
              x1: data.x1,
              x2: data.x2,
              y1: data.y2,
              y2: 0,
              "class": 'ct-bar-fill'
            });
          }
        });
      })();
    })();
  });
});