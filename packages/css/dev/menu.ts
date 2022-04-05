import html from "nanohtml";
import raw from "nanohtml/raw";

import "../lib/css";

// @ts-ignore
import OpenIcon from "bundle-text:../lib/scss/img/icons/gear.svg";
// @ts-ignore
import CloseIcon from "bundle-text:../lib/scss/img/icons/close.svg";

(() => {
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
      is="site-width-input"
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
      is="font-size-input"
    />
  </label>`;

  const themeSelect = html`<label for="theme-select">
    Theme
    <select id="theme-select" name="theme-select" is="theme-select"></select>
  </label>`;

  const simpleTextToggle = html`<label for="use-simple-text">
    Use Simple Text
    <input
      type="checkbox"
      id="use-simple-text"
      name="use-simple-text"
      is="simple-text-input"
    />
  </label>`;

  const motionToggle = html`<label for="motion-enabled">
    Enable Motion
    <input
      type="checkbox"
      id="motion-enabled"
      name="motion-enabled"
      is="motion-input"
    />
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

  const openMenu = () => {
    root.classList.add("Menu--open");
    root.classList.remove("Menu--close");
  };
  openBtn.addEventListener("click", openMenu);

  const closeMenu = () => {
    root.classList.add("Menu--close");
    root.classList.remove("Menu--open");
  };
  closeBtn.addEventListener("click", closeMenu);
})();
