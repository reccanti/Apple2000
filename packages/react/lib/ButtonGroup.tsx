import { ReactNode } from "react";

interface Props {
  children: ReactNode;
  className?: string;
  nowrap?: boolean;
}

export function ButtonGroup({
  children,
  className = "",
  nowrap = false,
}: Props) {
  const combinedClasses = [
    "ButtonGroup",
    nowrap ? "ButtonGroup--nowrap" : "",
    className,
  ].join(" ");

  return <div className={combinedClasses}>{children}</div>;
}
