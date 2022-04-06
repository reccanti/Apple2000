import { ReactNode } from "react";

interface Props {
  children: ReactNode;
  menu?: ReactNode;
}

export function Wrapper({ children, menu }: Props) {
  return (
    <div className="Wrapper">
      {menu}
      <main id="main" className="Wrapper-inner">
        {children}
      </main>
    </div>
  );
}
