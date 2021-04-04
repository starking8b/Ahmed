
$(function() {
    "use strict";

    var bsStepper = document.querySelectorAll(".bs-stepper");
    var  select = $(".select2");
    var  horizontalWizard = document.querySelector(".horizontal-wizard-example");


    // Adds crossed class
    if (typeof bsStepper !== undefined && bsStepper !== null) {
        for (var el = 0; el < bsStepper.length; ++el) {
            bsStepper[el].addEventListener("show.bs-stepper", function(event) {
                var index = event.detail.indexStep;
                var numberOfSteps = $(event.target).find(".step").length - 1;
                var line = $(event.target).find(".step");

                for (var i = 0; i < index; i++) {
                    line[i].classList.add("crossed");

                    for (var j = index; j < numberOfSteps; j++) {
                        line[j].classList.remove("crossed");
                    }
                }
                if (event.detail.to == 0) {
                    for (var k = index; k < numberOfSteps; k++) {
                        line[k].classList.remove("crossed");
                    }
                    line[0].classList.remove("crossed");
                }
            });
        }
    }

    // select2
    select.each(function() {
        var $this = $(this);
        $this.wrap('<div class="position-relative"></div>');
        $this.select2({
            placeholder: "Select value",
            dropdownParent: $this.parent()
        });
    });

    if (typeof horizontalWizard !== undefined && horizontalWizard !== null) {
        var numberedStepper = new Stepper(horizontalWizard);
        $(horizontalWizard)
            .find(".btn-next")
            .each(function() {
                $(this).on("click", function(e) {
                        numberedStepper.next();
                });
            });

        $(horizontalWizard)
            .find(".btn-prev")
            .on("click", function() {
                numberedStepper.previous();
            });
    }
});
