      (function () {
        'use strict';

        var snippetToggle = document.querySelector('#snippet-toggle');
        var snippets;

        snippetToggle.addEventListener('click', function () {
          if (snippets) {
            for (var i = 0; i < snippets.length; i++) {
              snippets[i].classList.toggle('auto-gen-code-visible');
            }
          }
        });

        window.onload = function () {
          createCodeSamples();
          snippets = document.querySelectorAll('.auto-gen-code-snippet');
        };

        function createCodeSamples() {
          var codeWrappers = document.querySelectorAll('.code-sample');

          for (var i = 0; i < codeWrappers.length; i++) {
            var codeWrapper = codeWrappers[i];
            var clonedNodes = getClonedNonTextNodes(codeWrapper);

            beautifyNodes(clonedNodes);

            var preElement = document.createElement('pre');
            var codeElement = document.createElement('code');

            for (var j = 0; j < clonedNodes.length; j++) {
              codeElement.appendChild(document.createTextNode(clonedNodes[j].outerHTML));

              if (j + 1 < clonedNodes.length) {
                codeElement.appendChild(document.createTextNode('\n'));
              }
            }

            preElement.appendChild(codeElement);
            preElement.classList.add('auto-gen-code-snippet');
            preElement.classList.add('container');

            var clearDiv = document.createElement('div');
            clearDiv.classList.add('clear');

            var parent = codeWrapper.parentNode;

            if (codeWrapper.nextSibling) {
              parent.insertBefore(preElement, codeWrapper.nextSibling);
            } else {
              parent.appendChild(preElement);
            }

            parent.insertBefore(clearDiv, preElement);
          }
        }

        function getClonedNonTextNodes(element) {
          var nonTextNodes = [];
          var childNodes = element.childNodes;

          for (var i = 0; i < childNodes.length; i++) {
            var childElement = childNodes[i];

            if (childElement.nodeType !== 3) {
              // Found a valid child element
              nonTextNodes.push(childElement.cloneNode(true));
            }
          }

          return nonTextNodes;
        }

        function beautifyNodes(elements) {
          for (var i = 0; i < elements.length; i++) {
            beautifyNode(elements[i], 0);
          }
        }

        function beautifyNode(element, depth) {
          var childNodes = element.childNodes;
          var singleIndent = '    ';
          var currentDepthSpacing = '';

          for (var i = 0; i < depth; i++) {
            currentDepthSpacing += singleIndent;
          }

          var nextDepthSpacing = currentDepthSpacing + singleIndent;

          for (var j = 0; j < childNodes.length; j++) {
            var childElement = childNodes[j];

            if (childElement.nodeType === 3) {
              // found a text node
              if (childElement.nodeValue.indexOf('\n') >= 0) {
                if (j + 1 < childNodes.length) {
                  childElement.nodeValue = '\n' + nextDepthSpacing;
                } else {
                  childElement.nodeValue = '\n' + currentDepthSpacing;
                }
              }
            } else {
              beautifyNode(childElement, depth + 1);
            }
          }
        }
      })();
