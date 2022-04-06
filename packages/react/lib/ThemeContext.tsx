import { createContext, useContext, useMemo, ReactNode } from "react";
import { ThemeManager } from "css/lib/css";

const ThemeContext = createContext<ThemeManager | null>(null);

export function useThemeSettings() {
  const manager = useContext(ThemeContext);
  if (!manager) {
    throw Error(
      "You must wrap your components in a ThemeProvider in order to access theme settings"
    );
  }
  return manager;
}

interface Props {
  children: ReactNode;
}

export function ThemeProvider({ children }: Props) {
  const manager = useMemo(() => new ThemeManager(), []);
  return (
    <ThemeContext.Provider value={manager}>{children}</ThemeContext.Provider>
  );
}
