import html from "nanohtml";
import { capitalCase } from "change-case";

import { ThemeManager, Apple2000eTheme } from "./ThemeManager";

const manager = new ThemeManager();

// Theme Select

class ThemeSelect extends HTMLSelectElement {
  constructor() {
    super();

    // initialize with the default themes

    const options = html`<optgroup label="WCAG AA">
        ${manager
          .getAAThemes()
          .map(
            (theme) =>
              html` <option value="${theme}">${capitalCase(theme)}</option> `
          )}
      </optgroup>
      <optgroup label="WCAG AAA">
        ${manager
          .getAAAThemes()
          .map(
            (theme) =>
              html` <option value="${theme}">${capitalCase(theme)}</option> `
          )}
      </optgroup>`;

    this.appendChild(options);

    // wire up events

    this.addEventListener("change", (event) => {
      const target = event.target as HTMLSelectElement;
      const theme = target.value as Apple2000eTheme;
      manager.theme = theme;
    });

    // set initial value

    this.value = manager.theme;
  }
}

// Site Width Input

class SiteWidthInput extends HTMLInputElement {
  constructor() {
    super();

    // wire up event handlers

    this.addEventListener("input", (event) => {
      const target = event.target as HTMLInputElement;
      const siteWidth = Number(target.value);
      if (siteWidth) {
        manager.siteWidth = siteWidth;
      }
    });

    // set initial value

    this.step = "1";
    if (Number(this.min) > manager.siteWidth) {
      this.min = manager.siteWidth.toString();
    }
    if (Number(this.max) < manager.siteWidth) {
      this.max = manager.siteWidth.toString(); // kind of a hack to make sure the value doesn't get overwritten
    }
    this.value = manager.siteWidth.toString();
  }
}

// Font Size Input

class FontSizeInput extends HTMLInputElement {
  constructor() {
    super();

    // wire up event handlers

    this.addEventListener("input", (event) => {
      const target = event.target as HTMLInputElement;
      const fontSize = Number(target.value);
      if (fontSize) {
        manager.fontSize = fontSize;
      }
    });

    // set initial value

    this.step = "0.01";
    if (Number(this.min) > manager.fontSize) {
      this.min = manager.fontSize.toString();
    }
    if (Number(this.max) < manager.fontSize) {
      this.max = manager.fontSize.toString(); // kind of a hack to make sure the value doesn't get overwritten
    }
    this.value = manager.fontSize.toString();
  }
}

// Motion Input

class MotionInput extends HTMLInputElement {
  constructor() {
    super();

    // wire up event handlers

    this.addEventListener("change", (event) => {
      const target = event.target as HTMLInputElement;
      const checked = target.checked;
      if (checked) {
        manager.motionEnabled = true;
      } else {
        manager.motionEnabled = false;
      }
    });

    // set initial value

    this.checked = manager.motionEnabled;
  }
}

// Simple Text Input

class SimpleTextInput extends HTMLInputElement {
  constructor() {
    super();

    // wire up event handlers

    this.addEventListener("change", (event) => {
      const target = event.target as HTMLInputElement;
      const checked = target.checked;
      if (checked) {
        manager.simpleTextEnabled = true;
      } else {
        manager.simpleTextEnabled = false;
      }
    });

    // set initial value

    this.checked = manager.simpleTextEnabled;
  }
}

// register custom elements

customElements.define("theme-select", ThemeSelect, { extends: "select" });
customElements.define("site-width-input", SiteWidthInput, { extends: "input" });
customElements.define("font-size-input", FontSizeInput, { extends: "input" });
customElements.define("motion-input", MotionInput, { extends: "input" });
customElements.define("simple-text-input", SimpleTextInput, {
  extends: "input",
});
