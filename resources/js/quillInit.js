import Quill from "quill/core";
import "quill/dist/quill.snow.css";
import "quill/dist/quill.bubble.css";
import 'quill-table-better/dist/quill-table-better.css';
import QuillTableBetter from 'quill-table-better';
import Toolbar from "quill/modules/toolbar";
import Snow from "quill/themes/snow";
import Bold from "quill/formats/bold";
import Italic from "quill/formats/italic";
import Header from "quill/formats/header";
import Link from "quill/formats/link";
import Image from "quill/formats/image";
import List from "quill/formats/list";
import TurndownService from 'turndown';


// --- QUIll REGISTRATION ---
window.Quill = Quill;
window.Quill.register({
  "modules/toolbar": Toolbar,
  "themes/snow": Snow,
  "formats/bold": Bold,
  "formats/italic": Italic,
  "formats/header": Header,
  "formats/link": Link,
  "formats/image": Image,
  "formats/list": List,
  "modules/table-better": QuillTableBetter,
}, true);