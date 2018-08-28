// (function() {
//   'use strict';
//
//   var cmds = document.getElementsByClassName('del');
//   var i;
//   // alert(cmds);
//
//   for (i = 0; i < cmds.length; i++) {
//     cmds[i].addEventListener('click', function(e) {
//       e.preventDefault();
//       if (confirm('are you sure?')) {
//         document.getElementById('form_' + this.dataset.id).submit();
//       }
//     });
//   }
//
// })();

function deletePost(e) {
  'use strict';

  if (confirm('本当に削除していいですか?')) {
  document.getElementById('form_' + e.dataset.id).submit();
  }
}
