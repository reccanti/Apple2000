"use strict";

import { ThemeManager } from "../lib/css";

describe("ThemeManager", () => {
  // re-initialize the manager each time
  let manager: ThemeManager;
  beforeEach(() => {
    manager = new ThemeManager();
  });

  describe("color theme", () => {
    it("can retrieve the default theme if none is set", () => {
      expect(manager.theme).toBe("white");
    });

    it("can set a different theme", () => {
      manager.theme = "black";
      expect(manager.theme).toBe("black");
    });

    it("retrieves a different theme when the enviroment is initialized with it", () => {
      for (const cls of manager.rootElement.classList) {
        if (cls.includes("theme-root--color")) {
          manager.rootElement.classList.remove(cls);
          manager.rootElement.classList.add("theme-root--color--salmon");
          break;
        }
      }
      expect(manager.rootElement.classList).toContain(
        "theme-root--color--salmon"
      );
      expect(manager.rootElement.classList).not.toContain(
        "theme-root--color--white"
      );

      expect(manager.theme).toBe("salmon");
    });
  });

  describe("simple text", () => {
    it("can retrieve a value for 'simpleTextEnabled', even if no value is set", () => {
      expect(manager.simpleTextEnabled).toBe(false);
    });

    it("can enable simple text", () => {
      manager.simpleTextEnabled = true;
      expect(manager.simpleTextEnabled).toBe(true);
    });

    it("retrieves a different value for 'simpleTextEnabled' when the enviroment is initialized with it", () => {
      manager.rootElement.classList.add("theme-root--simple-text");
      expect(manager.simpleTextEnabled).toBe(true);
    });
  });

  describe("motion", () => {
    it("can retrieve a value for 'motionEnabled', even if no value is set", () => {
      expect(manager.motionEnabled).toBe(true);
    });

    it("can disable motion", () => {
      manager.motionEnabled = false;
      expect(manager.motionEnabled).toBe(false);
    });

    it("retrieves a different value for 'motionEnabled' when the enviroment is initialized with it", () => {
      manager.rootElement.classList.add("theme-root--no-motion");
      expect(manager.motionEnabled).toBe(false);
    });
  });

  describe("site width", () => {
    /**
     * @TODO - this doesn't work. If you figure out a better way of loading in "default" css values.
     * re-enable this test, but for the time being, just test in the dev site.
     *
     * ~reccanti 4/4/2022
     */
    xit("can retrieve a default value for 'siteWidth', even if no value is set", () => {
      expect(manager.siteWidth).toBe(1100);
    });

    it("can set a new value for 'siteWidth'", () => {
      manager.siteWidth = 500;
      expect(manager.siteWidth).toBe(500);
    });

    it("retrieves a different value for 'siteWidth' when the enviroment is initialized with it", () => {
      manager.rootElement.style.setProperty("--site-width", "500px");
      expect(manager.siteWidth).toBe(500);
    });
  });

  describe("font size", () => {
    /**
     * @TODO - this doesn't work. If you figure out a better way of loading in "default" css values.
     * re-enable this test, but for the time being, just test in the dev site.
     *
     * ~reccanti 4/4/2022
     */
    xit("can retrieve a default value for 'fontSize', even if no value is set", () => {
      expect(manager.fontSize).toBe(1);
    });

    it("can set a new value for 'fontSize'", () => {
      manager.fontSize = 2;
      expect(manager.fontSize).toBe(2);
    });

    it("retrieves a different value for 'fontSize' when the enviroment is initialized with it", () => {
      manager.rootElement.style.setProperty("--font-base-size-multiplier", "2");
      expect(manager.fontSize).toBe(2);
    });
  });
});
