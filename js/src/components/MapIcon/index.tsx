import { FC, useEffect } from 'react'
import { useHover } from '@uidotdev/usehooks'
import { useAtom } from 'jotai';
import { selectedDataAtom } from '@/pages/atom';

export const MapIcon: FC<{
	postId: number,
	className?: string,
	building: string,
	top: number,
	left: number,
}> = ({
	postId,
	className = '',
	building,
	top = 0,
	left = 0,

}) => {
		const [ref, hovering] = useHover();
		const [selectedData, setSelectedData] = useAtom(selectedDataAtom);

		useEffect(() => {
			if (!hovering) {
				setSelectedData({
					postId: 0,
					selectAllIcons: false,
					building: undefined,
				})
				return;
			}
			setSelectedData({
				postId,
				selectAllIcons: false,
				building,
			})

		}, [hovering]);


		const isSelected = !!selectedData.postId && selectedData.postId === postId && (selectedData.selectAllIcons || hovering);

		return (
			<div ref={ref} className={`sh-map-icon ${className} ${isSelected ? 'sh-hovered' : ''}`} style={{
				top: `${top}%`,
				left: `${left}%`,
			}}>
				<svg aria-hidden="true" className={`e-font-icon-svg e-fas-map-marker-alt ${className}  ${isSelected ? 'sh-hovered' : ''
					}`} viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg">
					<path d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z"></path>
				</svg>
			</div>
		)
	}
