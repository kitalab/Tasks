/**
 * Tasks.Content Javascript
 *
 * @param {string} Controller name
 * @param {function($scope, NetCommonsWysiwyg)} Controller
 */
NetCommonsApp.controller('TaskContent',
    function($scope, NetCommonsWysiwyg) {
      /**
       * tinymce
       *
       * @type {object}
       */
      $scope.tinymce = NetCommonsWysiwyg.new();

      /**
       * TaskContent object
       *
       * @type {object}
       */
      $scope.taskContent = [];

      /**
       * Initialize
       *
       * @param {object} TaskContents data
       * @return {void}
       */
      $scope.initialize = function(data) {
        $scope.taskContent = data.TaskContent;
      };

    });
