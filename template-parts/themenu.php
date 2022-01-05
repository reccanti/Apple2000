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
              enableMotion: true,
            };
            this._state = this.initializeState();

            // register all elements
            this._root = root;
            this._themeRoot = document.querySelector("#theme-root");
            this._documentRoot = document.querySelector("html");
            this._openButton = this._root.querySelector(".Menu-open");
            this._closeButton = this._root.querySelector(".Menu-close");

            this._themeSelect = this._root.querySelector("select[name='theme-select']");
            this._textSizeSlider = this._root.querySelector("input[name='text-size-slider']");
            this._motionCheckbox = this._root.querySelector("input[name='turn-off-motion']");

            this._saveButton = this._root.querySelector("#save-settings");
            this._resetButton = this._root.querySelector("#reset-settings");

            // set initial values
            this.syncInputs();

            // add event listeners
            this._openButton.addEventListener("click", this.openMenu);
            this._closeButton.addEventListener("click", this.closeMenu);

            this._themeSelect.addEventListener("change", e => {
              const newColor = e.target.value
              if (newColor) {
                this.setState("theme", newColor);
                this.appendClasses();
              }
            });
            this._textSizeSlider.addEventListener("input", e => {
              const textSize = Number(e.target.value);
              if (textSize) { 
                this.setState("fontSizeMultiplier", textSize);
                this.appendStyles();
              }
            });
            this._motionCheckbox.addEventListener("change", e => {
              const isChecked = e.target.checked;
              if (isChecked) {
                this.setState("enableMotion", true);
              } else {
                this.setState("enableMotion", false);
              }
              this.appendClasses();
            });


            this._saveButton.addEventListener("click", this.saveState);
            this._resetButton.addEventListener("click", this.reset);
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

          // state sync stuff

          getFontSizeMultiplier = size => {
            return '--font-base-size-multiplier: ' + size;
          }

          getThemeClass = theme => {
            switch(theme) {
              case "blue":
                return "theme-root--blue";
              case "brown":
                return "theme-root--brown";
              case "darkGray":
                return "theme-root--darkGray";
              case "darkGreen":
                return "theme-root--darkGreen";
              case "purple":
                return "theme-root--purple";
              case "salmon":
                return "theme-root--salmon";
              case "black":
                return "theme-root--black";
              case "darkBlue":
                return "theme-root--darkBlue";
              case "lightBlue":
                return "theme-root--lightBlue";
              case "lightGray":
                return "theme-root--lightGray";
              case "lightGreen":
                return "theme-root--lightGreen";
              case "magenta":
                return "theme-root--magenta";
              case "orange":
                return "theme-root--orange";
              case "pink":
                return "theme-root--pink";
              case "white":
                return "theme-root--white";
              case "yellow":
                return "theme-root--yellow";
            }
            return "theme-root--white";
          }

          appendClasses = () => {
            const classes = ["theme-root"];
            Object.entries(this._state).forEach(([key, value]) => {
              switch (key) {
                case "theme":
                  classes.push(this.getThemeClass(value));
                  break;
                case "enableMotion":
                  if (!value) {
                    classes.push("theme-root--no-motion");
                  }
                  break;
              }
            });
            this._themeRoot.classList = classes.join(" ");
          }

          appendStyles = () => {
            const styles = [];
            Object.entries(this._state).forEach(([key, value]) => {
              switch (key) {
                case "fontSizeMultiplier":
                  styles.push(this.getFontSizeMultiplier(value));
                  break;
              }
            });
            this._documentRoot.style = styles.join("; ");
          }

          syncInputs = () => {
            Object.entries(this._state).forEach(([key, value]) => {
              switch (key) {
                case "theme":
                  this._themeSelect.value = value;
                  break;
                case "fontSizeMultiplier":
                  this._textSizeSlider.value = value;
                  break;
                case "enableMotion":
                  this._motionCheckbox.checked = value
              }
            });
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

          reset = () => {
            this._state = this._initialState;
            this.appendClasses();
            this.appendStyles();
            this.syncInputs();
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
        Enable Motion
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