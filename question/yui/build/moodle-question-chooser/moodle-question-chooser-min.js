YUI.add("moodle-question-chooser",function(n,o){var s="div.createnewquestion",r="div.chooserdialoguebody",u="div.choosertitle";function e(){e.superclass.constructor.apply(this,arguments)}n.extend(e,M.core.chooserdialogue,{initializer:function(){n.all("form").each(function(o){/question\/addquestion\.php/.test(o.getAttribute("action"))&&o.on("submit",this.displayQuestionChooser,this)},this)},displayQuestionChooser:function(o){var e,i=n.one(s+" "+r),t=n.one(s+" "+u);null===this.container&&(this.setup_chooser_dialogue(i,t,{}),this.prepare_chooser()),i=o.target.ancestor("form",!0),e=this.container.one("form"),t=i.all('input[type="hidden"]'),e.all("input.customfield").remove(),t.each(function(o){e.appendChild(o.cloneNode()).removeAttribute("id").addClass("customfield")}),this.display_chooser(o)}},{NAME:"questionChooser"}),M.question=M.question||{},M.question.init_chooser=function(o){return new e(o)}},"@VERSION@",{requires:["moodle-core-chooserdialogue"]});