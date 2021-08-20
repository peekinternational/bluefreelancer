// jQuery(document).ready(function ($) {

  ! function () {
    $('[data-toggle="popover"]').popover();
  }(),
    // function () {
    //   document.addEventListener("DOMContentLoaded", function () {
    //     if (!window.Quill) {
    //       return $("#quill-editor,#quill-toolbar,#quill-bubble-editor,#quill-bubble-toolbar").remove();
    //     }
    //     var editor = new Quill("#quill-editor", {
    //       modules: {
    //         toolbar: "#quill-toolbar"
    //       },
    //       placeholder: "Type something",
    //       theme: "snow"
    //     });
    //   });
    // }(),
    function () {
      var e = document.querySelectorAll(".filepond");
      if (0 !== e.length) {
        "undefined" != typeof FilePondPluginFileValidateType && FilePond.registerPlugin(FilePondPluginFileValidateType),
          "undefined" != typeof FilePondPluginFileValidateSize && FilePond.registerPlugin(FilePondPluginFileValidateSize),
          "undefined" != typeof FilePondPluginImagePreview && FilePond.registerPlugin(FilePondPluginImagePreview),
          "undefined" != typeof FilePondPluginImageCrop && FilePond.registerPlugin(FilePondPluginImageCrop),
          "undefined" != typeof FilePondPluginImageResize && FilePond.registerPlugin(FilePondPluginImageResize),
          "undefined" != typeof FilePondPluginImageTransform && FilePond.registerPlugin(FilePondPluginImageTransform);
        for (var t = 0; t < e.length; t++) FilePond.create(e[t])
      }
    }(),
    function () {
      let rangeSlider = document.querySelectorAll('.range-slider');

      if (rangeSlider == null) return;

      for (let i = 0; i < rangeSlider.length; i++) {

        let rangeSliderUI = rangeSlider[i].querySelector(".range-slider-ui"),
          rangeSliderValueMin = rangeSlider[i].querySelector(".range-slider-value-min"),
          rangeSliderValueMax = rangeSlider[i].querySelector(".range-slider-value-max"),
          rangeSliderOptions = rangeSlider[i].dataset.rangeOptions,
          rangeSliderPrefix = rangeSlider[i].dataset.rangePrefix;

        let defaults = {
          start: 0,
          connect: 'lower',
          tooltips: !!0,
          step: 1,
          format: {
            to: function (e) {
              if (rangeSliderPrefix) {
                return rangeSliderPrefix + parseInt(e, 10);
              } else {
                return parseInt(e, 10)
              }
            },
            from: function (e) {
              return Number(e)
            }
          }
        };

        let userOptions;
        if (rangeSliderOptions != undefined) userOptions = JSON.parse(rangeSliderOptions);
        let options = { ...defaults, ...userOptions };

        noUiSlider.create(rangeSliderUI, options);

        if (rangeSliderValueMin || rangeSliderValueMax) {
          rangeSliderUI.noUiSlider.on("update", function (values, handle) {
            if (rangeSliderPrefix) {
              values = (values = values[handle]).replace(/\D/g, "");
            } else {
              values = (values = values[handle]);
            }

            if (handle) {
              rangeSliderValueMax.value = Math.round(values);
            } else {
              rangeSliderValueMin.value = Math.round(values);
            }
          });
        }

        if (rangeSliderValueMin) {
          rangeSliderValueMin.addEventListener("change", function () {
            rangeSliderUI.noUiSlider.set([this.value, null])
          });
        }

        if (rangeSliderValueMax) {
          rangeSliderValueMax.addEventListener("change", function () {
            rangeSliderUI.noUiSlider.set([null, this.value])
          });
        }
      }
    }();
    // function () {
    //   $('[data-toggle="select"]').each(function () {
    //     $(this).select2({
    //       placeholder: "Select value"
    //     });
    //   })
    // }();
// });