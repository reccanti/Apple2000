import { useMemo, ReactNode } from "react";

interface Props {
  children: ReactNode;
}

export function Wrapper({ children }: Props) {
  return (
    <div className="Wrapper">
      <main id="#main" className="Wrapper-inner">
        {children}
      </main>
    </div>
  );
}
