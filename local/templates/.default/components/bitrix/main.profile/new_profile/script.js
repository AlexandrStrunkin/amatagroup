
var t = document.forms.Tree;
var fieldset = [].filter.call(t.querySelectorAll('fieldset'), function(element) {return element;});
fieldset.forEach(function(eFieldset) {
  var main = [].filter.call(t.querySelectorAll('[type="checkbox"]'), function(element) {return element.parentNode.nextElementSibling == eFieldset;});
  main.forEach(function(eMain) {
    var all = eFieldset.querySelectorAll('[type="checkbox"]');
    eFieldset.onchange = function() {
      var allChecked = eFieldset.querySelectorAll('[type="checkbox"]:checked').length;
      eMain.checked = allChecked == all.length;
      eMain.indeterminate = allChecked > 0 && allChecked < all.length;
    }
    eMain.onclick = function() {
      for(var i=0; i<all.length; i++)
        all[i].checked = this.checked;
    }
  });
});
