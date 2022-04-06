import { useMemo, ReactNode } from "react";

interface Props {
  speed?: number;
  children: ReactNode;
}

export function Banner({ speed, children }: Props) {
  const style = useMemo(() => {
    let styleObj = {};
    if (speed) {
      styleObj = {
        "--banner-speed": `${speed}s`,
      };
    }
    return styleObj;
  }, [speed]);

  return (
    <div className="Banner" style={style}>
      <span className="Banner-inner">{children}</span>
    </div>
  );
}
