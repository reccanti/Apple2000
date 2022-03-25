import html from "nanohtml";
import raw from "nanohtml/raw";

import { capitalCase } from "change-case";

import { Apple2000eTheme, ThemeManager } from "../lib/css";

// @ts-ignore
import OpenIcon from "bundle-text:../lib/scss/img/icons/gear.svg";
// @ts-ignore
import CloseIcon from "bundle-text:../lib/scss/img/icons/close.svg";

(() => {
  // get the manager
  const manager = new ThemeManager();

  // get the color themes from the manager
  const aaThemes = manager.getAAThemes();
  const aaaThemes = manager.getAAAThemes();

  // construct UI
  const openBtn = html`<button class="Menu-open">
    <span class="Icon">${raw(OpenIcon)}</span>
  </button>`;

  const closeBtn = html`<button class="Menu-close">
    <span class="Icon">${raw(CloseIcon)}</span>
  </button>`;

  const siteWidthSlider = html`<label for="site-width-slider">
    Site Width
    <input
      type="range"
      name="site-width-slider"
      id="site-width-slider"
      min="1"
      max="2000"
      step="1"
      value="1100"
    />
  </label>`;

  const textSizeSlider = html`<label for="text-size-slider">
    Text Size
    <input
      type="range"
      name="text-size-slider"
      id="text-size-slider"
      min="1"
      max="3"
      step="0.01"
      value="1.5"
    />
  </label>`;

  const themeSelect = html`<label for="theme-select">
    Theme
    <select id="theme-select" name="theme-select">
      <optgroup label="WCAG AA">
        ${aaThemes.map(
          (theme) =>
            html` <option value="${theme}">${capitalCase(theme)}</option> `
        )}
      </optgroup>
      <optgroup label="WCAG AAA">
        ${aaaThemes.map(
          (theme) =>
            html` <option value="${theme}">${capitalCase(theme)}</option> `
        )}
      </optgroup>
    </select>
  </label>`;

  const simpleTextToggle = html`<label for="use-simple-text">
    Use Simple Text
    <input type="checkbox" id="use-simple-text" name="use-simple-text" />
  </label>`;

  const motionToggle = html`<label for="turn-off-motion">
    Disable Motion
    <input type="checkbox" id="turn-off-motion" name="turn-off-motion" />
  </label>`;

  const root = html`<nav class="Menu Menu--open">
      ${openBtn}
      <div class="Menu-contents Box">
        <nav class="Header">
          <header class="Header-inner">Settings</header>
          <div class="Header-buttons ButtonGroup ButtonGroup--nowrap">
            ${closeBtn}
          </div>
        </nav>
        <div class="Box-inner Menu-inner">
          ${themeSelect}
          ${siteWidthSlider}
          ${textSizeSlider}
          ${simpleTextToggle}
          ${motionToggle}
				</div>
			</div>
      </div>
    </nav>`;

  // insert the menu UI before the wrapper
  document.body.insertBefore(root, document.querySelector(".Wrapper"));

  // create event listeners and apply them

  const handleChangeTheme = (event) => {
    const theme = event.target.value as Apple2000eTheme;
    manager.switchTheme(theme);
  };
  themeSelect.addEventListener("change", handleChangeTheme);

  const openMenu = () => {
    console.log(root.children[0]);
    root.classList.add("Menu--open");
    root.classList.remove("Menu--close");
  };
  openBtn.addEventListener("click", openMenu);

  const closeMenu = () => {
    console.log(root.children[0]);
    root.classList.add("Menu--close");
    root.classList.remove("Menu--open");
  };
  closeBtn.addEventListener("click", closeMenu);

  const adjustSiteWidth = (event) => {
    const siteWidth = Number(event.target.value);
    if (siteWidth) {
      manager.setSiteWidth(siteWidth);
    }
  };
  siteWidthSlider.addEventListener("input", adjustSiteWidth);

  const adjustTextSize = (event) => {
    const textSize = Number(event.target.value);
    if (textSize) {
      manager.setFontSize(textSize);
    }
  };
  textSizeSlider.addEventListener("input", adjustTextSize);

  const toggleSimpleText = (event) => {
    const isChecked = event.target.checked;
    if (isChecked) {
      manager.useSimpleText(true);
    } else {
      manager.useSimpleText(false);
    }
  };
  simpleTextToggle.addEventListener("change", toggleSimpleText);

  const toggleMotion = (event) => {
    const isChecked = event.target.checked;
    if (isChecked) {
      manager.useMotion(false);
    } else {
      manager.useMotion(true);
    }
  };
  motionToggle.addEventListener("change", toggleMotion);
})();
