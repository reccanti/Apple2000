<?php
/**
 * Template part for rendering the menu
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package gutenberg-starter-theme
 */

?>

<?php 
  function addSettingsScript() {
    ?>
      <script>
        const SETTINGS_COOKIE = "apple-2000e-settings";
        class SettingsMenu {
          constructor(root) {
            // setup initial state
            this._initialState = {
              theme: "white",
              fontSizeMultiplier: 1.5,
            };
            this._state = this.initializeState();

            // register all elements
            this._root = root;
            this._themeRoot = document.querySelector("body");
            this._openButton = this._root.querySelector(".Menu-open");
            this._closeButton = this._root.querySelector(".Menu-close");

            this._themeSelect = this._root.querySelector("select[name='theme-select']");
            this._textSizeSlider = this._root.querySelector("input[name='text-size-slider']");

            this._saveButton = this._root.querySelector("#save-settings");
            this._resetButton = this._root.querySelector("#reset-settings");

            // set initial values
            this._themeSelect.value = this._state.theme;
            this._textSizeSlider.value = this._state.fontSizeMultiplier;

            // add event listeners
            this._openButton.addEventListener("click", this.openMenu);
            this._closeButton.addEventListener("click", this.closeMenu);
            this._themeSelect.addEventListener("change", this.switchTheme);
            this._textSizeSlider.addEventListener("input", this.adjustTextSize);
            this._saveButton.addEventListener("click", this.saveState);
          }

          // handler functions

          openMenu = () => {
            this._root.classList.add("Menu--open");
            this._root.classList.remove("Menu--close");
          }

          closeMenu = () => {
            this._root.classList.add("Menu--close");
            this._root.classList.remove("Menu--open");
          }

          adjustTextSize = e => {
            const textSize = Number(e.target.value);
            if (textSize) {
              this.setState("fontSizeMultiplier", textSize);
              document.documentElement.style.setProperty('--font-base-size-multiplier', textSize);
            }
          }

          switchTheme = e => {
            const newColor = e.target.value
            if (newColor) {
              this.setState("theme", newColor);

              this._themeRoot.className = "theme-root";
              switch(newColor) {
                case "blue":
                  this._themeRoot.classList.add("theme-root--blue");
                  break;
                case "brown":
                  this._themeRoot.classList.add("theme-root--brown");
                  break;	
                case "darkGray":
                  this._themeRoot.classList.add("theme-root--darkGray");
                  break;	
                case "darkGreen":
                  this._themeRoot.classList.add("theme-root--darkGreen");
                  break;	
                case "purple":
                  this._themeRoot.classList.add("theme-root--purple");
                  break;	
                case "salmon":
                  this._themeRoot.classList.add("theme-root--salmon");
                  break;	
                case "black":
                  this._themeRoot.classList.add("theme-root--black");
                  break;	
                case "darkBlue":
                  this._themeRoot.classList.add("theme-root--darkBlue");
                  break;
                case "lightBlue":
                  this._themeRoot.classList.add("theme-root--lightBlue");
                  break;	
                case "lightGray":
                  this._themeRoot.classList.add("theme-root--lightGray");
                  break;	
                case "lightGreen":
                  this._themeRoot.classList.add("theme-root--lightGreen");
                  break;	
                case "magenta":
                  this._themeRoot.classList.add("theme-root--magenta");
                  break;
                case "orange":
                  this._themeRoot.classList.add("theme-root--orange");
                  break;	
                case "pink":
                  this._themeRoot.classList.add("theme-root--pink");
                  break;	
                case "white":
                  this._themeRoot.classList.add("theme-root--white");
                  break;	
                case "yellow":
                  this._themeRoot.classList.add("theme-root--yellow");
                  break;
              }
            }
          }

          // state/cookie functions

          getStateCookie = () => {
            const data = document.cookie.split("; ").find(row => row.includes(SETTINGS_COOKIE));
            if (data) {
              const [_, ...rest] = data.split("=");
              if (rest && rest.length) {
                const value = rest.join("");
                return JSON.parse(value);
              }
            }
            return null;
          }

          initializeState = () => {
            const state = this.getStateCookie();
            if (state) {
              return { ...this._initialState, ...state };
            }
            return this._initialState;
          }

          saveState = () => {
            const serializedValue = JSON.stringify(this._state);
            const expirationDate = (1000 * 60 * 60 * 24 * 365) + Date.now(); // 1 year from now

            const cookieString = `${SETTINGS_COOKIE}=${serializedValue}; expires=${expirationDate}; Secure`
            document.cookie = cookieString;
          }

          setState = (key, value) => {
            this._state = {
              ...this._state,
              [key]: value
            }
          }

          resetState = () => {
            this._state = this._initialState;
          }
        }
        window.addEventListener("load", () => { new SettingsMenu(document.querySelector("#SettingsMenu")); });
      </script>
    <?php
  }
  add_action('wp_footer', 'addSettingsScript');
?>

<?php 
  $menu_icon = file_get_contents(get_template_directory() . '/css/img/icons/gear.svg');
  $close_icon = file_get_contents(get_template_directory() . '/css/img/icons/close.svg');
?>

<nav id="SettingsMenu" class="Menu Menu--close">
  <button class="Menu-open">
    <span class="Icon">
      <?php echo $menu_icon ?>
    </span>
  </button>
  <div class="Menu-contents Box">
    <nav class="Header">
      <header class="Header-inner">Settings</header>
      <div class="Header-buttons ButtonGroup ButtonGroup--nowrap">
        <button class="Menu-close">
          <span class="Icon">
            <?php echo $close_icon ?>
          </span>
        </button>
      </div>
    </nav>
    <div class="Box-inner Menu-inner">
      <label for="theme-select">
        Theme
        <select id="theme-select" name="theme-select">
          <optgroup label="WCAG AA">
            <option value="blue">Blue</option>
            <option value="brown">Brown</option>
            <option value="darkGray">Dark Gray</option>
            <option value="darkGreen">Dark Green</option>
            <option value="purple">Purple</option>
            <option value="salmon">Salmon</option>
          </optgroup>
          <optgroup label="WCAG AAA">
            <option value="black">Black</option>
            <option value="darkBlue">Dark Blue</option>
            <option value="lightBlue">Light Blue</option>
            <option value="lightGray">Light Gray</option>
            <option value="lightGreen">Light Green</option>
            <option value="magenta">Magenta</option>
            <option value="orange">Orange</option>
            <option value="pink">Pink</option>
            <option selected value="white">White</option>
            <option value="yellow">Yellow</option>
          </optgroup>
        </select>
      </label>
      <label for="text-size-slider">
        Text Size
        <input type="range" name="text-size-slider" id="text-size-slider" min="1" max="3" step="0.01" value="1.5" />
      </label>
      <label for="use-simple-text">
        Use Simple Text
        <input type="checkbox" id="use-simple-text" name="use-simple-text" />
      </label>
      <label for="turn-off-motion">
        Turn Off Motion
        <input type="checkbox" id="turn-off-motion" name="turn-off-motion" />
      </label>
      <div class="ButtonGroup">
        <button id="save-settings">
          Save Settings
        </button>
        <button id="reset-settings">
          Reset to Defaults
        </button>
      </div>  
    </div>
  </div>
</nav>