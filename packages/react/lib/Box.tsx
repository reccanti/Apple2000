import { useMemo, ReactNode, CSSProperties } from "react";
import { ButtonGroup } from "./ButtonGroup";

interface BoxProps {
  children: ReactNode;
  header?: ReactNode;
  className?: string;
  style?: CSSProperties;
}

export function Box({
  children,
  header,
  className = "",
  style = {},
}: BoxProps) {
  const combinedClasses = useMemo(
    () => ["Box", className].join(" "),
    [className]
  );
  const combinedStyles = useMemo(() => ({ ...style }), [style]);

  return (
    <div style={combinedStyles} className={combinedClasses}>
      {header}
      <div className="Box-inner">{children}</div>
    </div>
  );
}

interface HeaderProps {
  children: ReactNode;
  actionButtons?: ReactNode;
}

function Header({ children, actionButtons }: HeaderProps) {
  return (
    <nav className="Header">
      <header className="Header-inner">{children}</header>
      {actionButtons && (
        <ButtonGroup nowrap className="Header-buttons">
          {actionButtons}
        </ButtonGroup>
      )}
    </nav>
  );
}

Box.Header = Header;
