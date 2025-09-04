import "quill/dist/quill.snow.css";
import 'quill-table-better/dist/quill-table-better.css';
import QuillTableBetter from 'quill-table-better';
import TurndownService from 'turndown';


// --- QUIll REGISTRATION ---
Quill.register({
  "modules/table-better": QuillTableBetter,
}, true);

if (document.querySelector("#viewer[attr-readonly]")) {
  let viewer = new Quill('#viewer[attr-readonly]', {
    readOnly: true,
    theme: 'bubble'
  });

  viewer.updateContents(window.deskripsiDelta || "");
}

if (document.querySelector("#deskripsi")) {

  // --- QUILL INSTANCE ---
  const turndownService = new TurndownService();
  const quill = new Quill("#deskripsi", {
    theme: "snow",
    modules: {
      toolbar: {
        container: [
          ["bold", "italic", "underline", "strike"],
          ["blockquote", "code-block"],
          ["link", "image", "video", "formula"],

          [{ header: 1 }, { header: 2 }],
          [{ list: "ordered" }, { list: "bullet" }, { list: "check" }],
          [{ script: "sub" }, { script: "super" }],
          [{ indent: "-1" }, { indent: "+1" }],
          [{ direction: "rtl" }],

          [{ size: ["small", false, "large", "huge"] }],
          [{ header: [1, 2, 3, 4, 5, 6, false] }],

          [{ color: [] }, { background: [] }],
          [{ font: [] }],
          [{ align: [] }],
          ["table-better"],
          ["clean"],
        ],
        handlers: {
          ...(window.handlers || {})
        },
        keyboard: {
          bindings: QuillTableBetter.keyboardBindings
        }
      },
      table: false,
      "table-better": {
        language: "en_US",
        menus: ["column", "row", "merge", "table", "cell", "wrap", "copy", "delete"],
        toolbarTable: true,
      },
    },
  });

  quill.updateContents(window.deskripsiDelta || "");

  if (window.mediasURLHandler) {
    // Get all <img> elements inside the editor
    const images = quill.root.querySelectorAll('img');

    // Convert NodeList to array if you need
    window.mediasURLHandler(Array.from(images).map(img => img.src));
  }

  quill.on('editor-change', (eventName, ...args) => {
    if (eventName === 'text-change') {

      if (window.quillTextChangeEventHandler) {
        const module = quill.getModule('table-better');
        module.hideTools();
        window.quillTextChangeEventHandler(quill, JSON.stringify(quill.getContents()));
      }
      // Handle deletion logic here
      const delta = args[0];
      // Check for image removals in the delta
      const removedImages = delta.ops.filter(op => op.hasOwnProperty('delete'));

      if (removedImages.length > 0) {
        // Compare current images with the initial list
        if (handleImageDeletion) handleImageDeletion(quill);
      }
    }
  });

  // --- FORM SUBMISSION ---
  let form = document.querySelector("form[editor-attach]");
  if (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();
      const module = quill.getModule('table-better');
      module.hideTools();
      const deltainput = document.createElement("input");
      deltainput.type = "hidden";
      deltainput.name = "deskripsi";
      deltainput.value = JSON.stringify(quill.getContents());
      form.appendChild(deltainput);
      form.submit();
    });
  }
}

