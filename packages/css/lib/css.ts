"use strict";

const apple2000eAAThemeList = [
  "blue",
  "brown",
  "darkGray",
  "darkGreen",
  "purple",
  "salmon",
] as const;

const apple2000eAAAThemeList = [
  "black",
  "darkBlue",
  "lightBlue",
  "lightGray",
  "lightGreen",
  "magenta",
  "orange",
  "pink",
  "white",
  "yellow",
] as const;

export type Apple2000eTheme =
  | typeof apple2000eAAThemeList[number]
  | typeof apple2000eAAAThemeList[number];

export class ThemeManager {
  rootElement: HTMLElement;

  constructor() {
    // get the root element so that we can modify stuff
    this.rootElement = document.querySelector(
      ".theme-root"
    ) as HTMLElement | null;
    if (!this.rootElement) {
      document.body.classList.add("theme-root", "theme-root--white");
      this.rootElement = document.body;
    }
  }

  switchTheme(theme: Apple2000eTheme) {
    for (const cls of this.rootElement.classList) {
      if (cls.includes("theme-root--color")) {
        this.rootElement.classList.add(`theme-root--color--${theme}`);
        this.rootElement.classList.remove(cls);
        break;
      }
    }
  }

  getAAThemes() {
    return apple2000eAAThemeList;
  }

  getAAAThemes() {
    return apple2000eAAAThemeList;
  }

  useSimpleText(shouldUse: boolean) {
    if (shouldUse) {
      this.rootElement.classList.add(`theme-root--simple-text`);
    } else {
      this.rootElement.classList.remove(`theme-root--simple-text`);
    }
  }

  useMotion(shouldUse: boolean) {
    if (shouldUse) {
      this.rootElement.classList.remove(`theme-root--no-motion`);
    } else {
      this.rootElement.classList.add(`theme-root--no-motion`);
    }
  }

  setSiteWidth(width: number) {
    this.rootElement.style.setProperty("--site-width", `${width}px`);
  }

  setFontSize(size: number) {
    this.rootElement.style.setProperty(
      "--font-base-size-multiplier",
      `${size}`
    );
  }
}
