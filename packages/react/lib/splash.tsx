import { useMemo, ReactNode } from "react";

interface Props {
  children: ReactNode;
}

export function Splash({ children }: Props) {
  return <div className="Splash">{children}</div>;
}
