import { useMemo, ReactNode } from "react";

interface Props {
  children: ReactNode;
}

export function Box({ children }: Props) {
  return (
    <div className="Box">
      <div className="Box-inner">{children}</div>
    </div>
  );
}
