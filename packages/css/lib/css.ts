"use strict";

// definitions for our different color themes

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

// a utility so that we don't have to re-type all of our class names
// if we want to change the names or add a new theme

const themeClassLookup = new Map<string, Apple2000eTheme>(
  [...apple2000eAAThemeList, ...apple2000eAAAThemeList].map((theme) => [
    `theme-root--color--${theme}`,
    theme,
  ])
);

// the actual class where we can manage our themes

export class ThemeManager {
  readonly rootElement: HTMLElement;

  constructor() {
    // get the root element so that we can modify stuff
    this.rootElement = document.querySelector(
      ".theme-root"
    ) as HTMLElement | null;
    if (!this.rootElement) {
      document.body.classList.add("theme-root", "theme-root--color--white");
      this.rootElement = document.body;
    }
  }

  // extracts the theme-color from the class applied to the theme root,
  // using the themeClassLookup table to find the color associated with
  // the current className
  get theme(): Apple2000eTheme {
    const themeClass = Array.from(this.rootElement.classList).find((cls) =>
      cls.includes("theme-root--color")
    );
    const theme = themeClassLookup.get(themeClass);
    if (!theme) {
      return "white"; // the default theme
    }
    return theme;
  }

  set theme(value: Apple2000eTheme) {
    for (const cls of this.rootElement.classList) {
      if (cls.includes("theme-root--color")) {
        this.rootElement.classList.add(`theme-root--color--${value}`);
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

  get simpleTextEnabled() {
    return this.rootElement.classList.contains("theme-root--simple-text");
  }

  set simpleTextEnabled(shouldUse: boolean) {
    if (shouldUse) {
      this.rootElement.classList.add(`theme-root--simple-text`);
    } else {
      this.rootElement.classList.remove(`theme-root--simple-text`);
    }
  }

  get motionEnabled() {
    return !this.rootElement.classList.contains("theme-root--no-motion");
  }

  set motionEnabled(shouldUse: boolean) {
    if (shouldUse) {
      this.rootElement.classList.remove(`theme-root--no-motion`);
    } else {
      this.rootElement.classList.add(`theme-root--no-motion`);
    }
  }

  get siteWidth() {
    const widthString = window
      .getComputedStyle(this.rootElement)
      .getPropertyValue("--site-width");
    const widthStringNumber = widthString.replace("px", "");
    return Number(widthStringNumber);
  }

  set siteWidth(width: number) {
    this.rootElement.style.setProperty("--site-width", `${width}px`);
  }

  get fontSize() {
    const fontString = window
      .getComputedStyle(this.rootElement)
      .getPropertyValue("--font-base-size-multiplier");
    return Number(fontString);
  }

  set fontSize(size: number) {
    this.rootElement.style.setProperty(
      "--font-base-size-multiplier",
      `${size}`
    );
  }
}
